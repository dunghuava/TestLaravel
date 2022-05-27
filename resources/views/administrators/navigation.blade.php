<section class="container mt-2">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Administrator</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{route('admin')}}">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('admin.product.list')}}">Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.order.list')}}">Order</a>
            </li>
          </ul>
        </div>
      </nav>
</section>
