<nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
      </ul>
      <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                 <form action="{{ route('logout') }}" method="post">
                       @csrf
                       <button onclick="return confirm('logout?')" type="submit" class="btn btn-outline-secondary"> 
                        <i class="fa fa-sign-out-alt mr-2"></i>  Logout
                  </button>
                 </form>
            </li>
      </ul>
</nav>