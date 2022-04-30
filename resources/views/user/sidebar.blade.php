
<div class="card">
    <div class="card-header">Welcome , {{ Auth::user()->name }}</div>
    <div class="card-body">
         <div class="mx-auto pb-3" style="width: 50%">
            <img class="" width="80%" style="border-radius: 100%; border: 1px solid seagreen"  src="{{ asset('public/frontend') }}/images/avatar3.png">
         </div>
         <ul class="list-group list-group-flush">
            <a href="{{ route('profile') }}" class="text-muted"> <li class="list-group-item {{ Route::is('profile') ? 'activesidebar' : '' }}"><i class="fas fa-home"></i> Dashboard</li></a>
            <a href="{{ route('wishlist.page') }}" class="text-muted"> <li class="list-group-item"> <i class="far fa-heart"></i> Wishlist</li></a>
            <a href="" class="text-muted"> <li class="list-group-item"> <i class="fas fa-file-alt"></i>  My Order</li></a>

            <a href="{{ route('customar.setting') }}" class="text-muted"> <li class="list-group-item {{ Route::is('customar.setting') ? 'activesidebar' : '' }}"><i class="fas fa-edit"></i> Setting</li> </a>
            <a href="" class="text-muted"> <li class="list-group-item"> <i class="fab fa-telegram-plane"></i> Open Ticket</li> </a>
            <a href="{{ route('customar.logout') }}" class="text-muted"> <li class="list-group-item"> <i class="fas fa-sign-out-alt"></i> Logout</li> </a>
           </ul>

    </div>
</div>
