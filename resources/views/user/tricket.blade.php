@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('user.sidebar')
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('All Trickets') }}
                    <a href="{{ route('write.tricket') }}" style="float:right;"><i class="fas fa-pencil-alt"></i> Open a Tricket</a>
                </div>

                <div class="card-body">
                   <div>
                       <table class="table">
                         <thead>
                           <tr>
                             <th scope="col">Date</th>
                             <th scope="col">Service</th>
                             <th scope="col">Subject</th>
                             <th scope="col">Status</th>
                             <th scope="col">Action</th>
                           </tr>
                         </thead>
                         <tbody>
                          @foreach($tricket as $row)
                           <tr>
                             <th scope="row">{{ $row->date }}</th>
                             <td>{{ $row->service }}</td>
                             <td>{{ $row->subject }}</td>
                             <td>
                              @if($row->status==0)
                                 <span class="badge badge-danger">Pending</span>
                              @elseif($row->status==1)
                                 <span class="badge badge-info">Replied</span>
                              @elseif($row->status==2)
                                 <span class="badge badge-primary">Closed</span>
                              @endif
                            </td>
                            <td>
                            	<a href="{{ route('show.tricket', $row->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                            </td>
                           </tr>
                          @endforeach
                         </tbody>
                       </table>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div><hr>
@endsection
