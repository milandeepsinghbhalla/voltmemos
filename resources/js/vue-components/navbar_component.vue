<template>
    <nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img class="logo" src="logo_images/logo.png" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas bg-dark offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header text-light">
        <h5 class="offcanvas-title text-light text-muted" id="offcanvasNavbarLabel">Menu</h5>
        <span class="text-light text-muted" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fas fa-times display-6"></i></span>
      </div>
       <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <router-link to="/all_blogs" class="nav-link" ><span data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">All Blogs</span></router-link>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Mobiles
            </a>
            <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
              <router-link to="/mobile_review" class="dropdown-item"><li data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">Reiviews</li></router-link>
              <router-link to="/mobile_best_under" class="dropdown-item"><li data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">Best under</li></router-link>
              <router-link to="/mobile_comparison" class="dropdown-item"><li data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">Comparison</li></router-link>
              <!-- <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li> -->
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Laptops
            </a>
            <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
              <router-link to="/laptop_review" class="dropdown-item"> <li data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">Reiviews</li></router-link>
              <router-link to="/laptop_best_under" class="dropdown-item"><li data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">Best under</li></router-link>
              <router-link to="/laptop_comparison" class="dropdown-item"> <li  data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">Comparison</li></router-link>

              <!-- <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li> -->
            </ul>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </div>
</nav>
</template>