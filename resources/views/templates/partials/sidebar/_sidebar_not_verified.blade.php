<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <div class="nav-link">
          <div class="profile-image">
            <img src="{{ asset('assets/images/user.png') }}" alt="image"/>
            <span class="online-status online"></span> <!--change class online to offline or busy as needed-->
          </div>
          <div class="profile-name">
            <p class="name">
                {{ Str::limit(Auth()->user()->name, 20) }}
            </p>
            <p class="designation">
              {{ Str::limit(Auth()->user()->role->description, 30) }}
            </p>
          </div>
        </div>
      </li>

    </ul>
  </nav>
  <!-- partial -->
