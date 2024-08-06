@include('layouts.header')
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-4" style="width: 1100px">
            <div class="card">
                <div class="card-header">orders</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <table style="width: 700px">
                            <thead>
                                <th>item</th>
                                <th>number</th>
                                <th>price</th>
                                <th>payment status</th>
                            </thead>
                            <tbody>
                                @if ($order)
                                    @foreach ($order as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->payment_method}}</td>
                                        <td>{{$item->total}}</td>
                                        {{-- $item->payment_status --}}
                                        <td>yes</td> 
                                    </tr>
                                    @endforeach
                                @else
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                @endif
                                
                            </tbody>
                            
                        </table>
                        <a href="#" class="btn btn-primary m-3">my sells</a>
                    {{-- {{ __('You are logged in!') }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">        
        <div class="col-md-8 mt-4" style="width: 1100px">
            <div class="card">
                <div class="card-header">orders</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <table style="width: 700px">
                            <thead>
                                <th>item</th>
                                <th>number</th>
                                <th>price</th>
                                <th>payment status</th>
                            </thead>
                            <tbody>
                                @if ($order)
                                    @foreach ($order as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->payment_method}}</td>
                                        <td>{{$item->total}}</td>
                                        {{-- $item->payment_status --}}
                                        <td>yes</td> 
                                    </tr>
                                    @endforeach
                                @else
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                @endif
                                
                            </tbody>
                            
                        </table>
                    {{-- {{ __('You are logged in!') }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
