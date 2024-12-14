<table>
    <thead>
        <tr>
        <th>Name</th>
        <th>Image</th>
        <th>Price</th>
        <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($products as $key => $product)
        <tr id="row-{{ $product->id }}" class="product-row">
            <td>{{$product->name}}</td>
            <td><img style="max-width:100px" src="{{$product->image_url}}" alt="" /></td>
            <td>{{$product->price}}</td>
            <td>
            <button
                    class="btn btn-danger btn-sm"
                    onclick="removeFromBasket('{{ $key }}')">
                    Kaldır
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
