@extends('layouts.app')

@section('content')
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Campaigns</h1>
      </div>

      <h2>Campaign Edit</h2>
      <div class="table-responsive small">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Adı</th>
              <th scope="col">Minimum Tutar</th>
              <th scope="col">Hediye Ürün</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($campaigns as $campaign)
            <tr>
              <td>{{ $campaign->id }}</td>
              <td>{{ $campaign->name }}</td>
              <td>
                <span id="moc_{{ $campaign->id }}">{{ $campaign->min_order_cost }}</span>
                <button
                    onclick="getCampaign('{{ $campaign->id }}')"
                    style="
                        background-color: #4CAF50;
                        color: white;
                        border: none;
                        padding: 8px;
                        border-radius: 4px;
                        cursor: pointer;
                        font-size: 16px;
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                    "
                    data-bs-toggle="modal" data-bs-target="#campaignModal"
                    >
                    <i class="fa-regular fa-pen-to-square"></i>
                </button>
              </td>
              <td>
              @foreach ($campaign->products as $product)
                {{ $product->name}}<br />
              @endforeach
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="modal fade" id="campaignModal" tabindex="-1" aria-labelledby="campaignModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                  <h5 class="modal-title" id="campaignName"></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <!-- Modal Body -->
              <div class="modal-body">
                  <form id="campaignUpdateForm" onsubmit="updateCampaign(event)">
                      <div class="mb-3">
                          <label for="campaignMinAmount" class="form-label">Kampanya Min Tutar</label>
                          <input type="text" class="form-control" id="min_order_cost" required>
                          <input type="hidden" id="campaign_id">
                      </div>
                  </form>
              </div>
              <!-- Modal Footer -->
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                  <button type="submit" class="btn btn-primary" form="campaignUpdateForm">Güncelle</button>
              </div>
          </div>
        </div>
      </div>
      <script>
        function getCampaign(id) {
            fetch('/campaigns/' + id)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Kampanya bulunamadı');
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('campaignName').innerText = data.name;
                    document.getElementById('min_order_cost').value = data.min_order_cost;
                    document.getElementById('campaign_id').value = data.id;
                })
                .catch(error => {
                    console.error('Hata:', error.message);
                });
        }
        function updateCampaign(event) {
          event.preventDefault();

            let id = document.getElementById('campaign_id').value;
            let minOrderCost = document.getElementById('min_order_cost').value;
            let formData = {
                min_order_cost: minOrderCost
            };

            fetch('/campaigns/' + id, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(formData)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Güncelleme başarısız');
                }
                
                document.getElementById('moc_'+id).innerText = minOrderCost;

                var modal = document.getElementById('campaignModal');
                var modalInstance = bootstrap.Modal.getInstance(modal);
                modalInstance.hide();
            })
            .catch(error => {
                console.error('Hata:', error.message);
            });
        }
      </script>
@endsection
