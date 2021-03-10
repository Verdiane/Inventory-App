@extends('layouts.app')

@section('content')

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Image</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Quantity</th>
      <th scope="col">Price</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>

    @foreach($orders as $order)
    <tr>
        <td class="serial">{{ $order->id }}.</td>
        <td class="avatar">
            <div class="round-img">
                <a href="javascript:void(0)" data-toggle="modal" data-target="#largeModal{{ $order->id }}" title="Click to enlarge image">
                    <img class="" height="50" width="100"
                         src="{{ asset('/storage/images/orders/'.$order->item_image) }}"
                         alt="">
                </a>
            </div>
        </td>
        <td>
            <span class="name">
                {{ $order->item_name }}
            </span>
        </td>
        <td>{{ mb_strimwidth($order->description, 0, 50, "...") }}</span></td>
        <td>{{ $order->quantity }}</td>
        <td>{{ $order->price }}</td> 
        <td>
            <a href="{{ route('orders.edit', $order->id) }}">
                <button type="button" class="btn btn-warning btn-sm" style="padding: 5px 10px;">Edit</button>
            </a>
            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $order->id }}" style="padding: 5px 10px;">Delete</button>
        </td>
    </tr>

    <div class="modal fade" id="deleteModal{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterLabel">Confirm Delete </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <form method="POST" action="{{ route('orders.destroy', $order->id) }}">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                  <input type="hidden" name="_method" value="DELETE">
                  <div class="modal-body">
                      <div class="row">
                          <div class="col-md-12">
                              Are you sure you want to delete this item ({{ $order->item_name }}) ?
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                      <button type="submit" class="btn btn-primary">YES</button>
                  </div>
              </form>
           </div>
      </div>
    </div>

    <div class="modal fade" id="largeModal{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-body text-center">
                  <img src="{{ asset('/storage/images/orders/'.$order->item_image) }}"
                        height="500">
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              </div>
          </div>
      </div>
   </div>
 
  @endforeach

  </tbody>
    
</table>

{{-- col-lg-8 col-md-8 --}}
<div class="col-sm-12  text-center">
    <a href="{{ route('inventories.index') }}">
        <button type="button" class="btn btn-primary float-center"style="padding: 5px 10px;">Back</button>
    </a>
</div>


@endsection