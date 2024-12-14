@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
            <svg class="bi"><use xlink:href="#calendar3"/></svg>
            This week
          </button>
        </div>
      </div>

      <h2>Product List</h2>
      <div class="table-responsive small">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Code</th>
              <th scope="col">Image</th>
              <th scope="col">Price</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $product)
            <tr>
              <td>{{ $product->id }}</td>
              <td>{{ $product->name }}</td>
              <td>{{ $product->code }}</td>
              <td>
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" width="50">
              </td>
              <td>${{ number_format($product->price, 2) }}</td>
              <td><button onclick="addToBasket('{{ $product->id }}')">Sepete At</button></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <button id="myBasket" onclick="getBasket();" style="float:right;" data-bs-toggle="modal" data-bs-target="#basketModal">Sepetim({{$bpCount}})</button>

      <div class="modal fade" id="basketModal" tabindex="-1" aria-labelledby="basketModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                  <h5 class="modal-title" id="campaignName"></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <!-- Modal Body -->
              <div class="modal-body" id="basketContainer">
                  
              </div>
              <!-- Modal Footer -->
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                  <button type="button" class="btn btn-primary" onclick="buy();">Satın Al</button>
              </div>
          </div>
        </div>
      </div>
      <script>

        function buy() {
          fetch('/order', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                
                if (!response.ok) {
                    throw new Error('Sipariş başarısız');
                }
                return response.json();
            })
            .then(data => {
              let orderText="";
              for(var i in data) {
                if(data[i].campaign_id!=undefined) {
                  orderText+="Kampanya Hediyesi:" + data[i].pid + "\n";
                }
                else {
                  orderText+= "Satın Alınan Ürün:" +data[i].pid +"("+data[i].price+")\n";
                }
              }
              alert(orderText);
              updateBasketButton(0);
              getBasket();
            }).catch(error => {
                console.error('Hata:', error.message);
            });
        }

        function getBasket(){
          fetch('/basket', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                
                if (!response.ok) {
                    throw new Error('Liste çekme başarısız');
                }
                return response.text();
            })
            .then(html => {
              document.getElementById("basketContainer").innerHTML = html;
            }).catch(error => {
                console.error('Hata:', error.message);
            });
        }

        function addToBasket(product_id) {
          fetch('/basket/' + product_id, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                
                if (!response.ok) {
                    throw new Error('Güncelleme başarısız');
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                updateBasketButton(data.count);
            })
            .catch(error => {
                console.error('Hata:', error.message);
            });
        }

        function updateBasketButton(count) {
          document.getElementById("myBasket").innerHTML='Sepetim('+count+')';
        }

        function removeFromBasket(productId) {
            fetch('/basket/remove/' + productId, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, // CSRF token
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Silme işlemi başarısız oldu.');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Satırı tablodan kaldır
                    updateBasketButton(document.querySelectorAll('.product-row').length-1);
                    getBasket();
                    alert('Ürün sepetten kaldırıldı!');
                } else {
                    alert('Silme işlemi sırasında bir hata oluştu.');
                }
            })
            .catch(error => {
                console.error('Hata:', error.message);
            });
        }
      </script>
@endsection
