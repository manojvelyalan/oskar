<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile mt-3">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="<?=($currentUser->profilePic != '')?$currentUser->profilePic    :'images/faces/profile.png';?>" alt="profile image">
                </div>
                <div class="text-wrapper">
                    <p class="profile-name mt-1"><label class="pb-1">Admin</label></p>
                  <div>
                    <small class="designation text-muted"> Admin</small>
                   
                  </div>
                </div>
              </div>
              
            </div>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="listallcustomer">
              <i class="menu-icon fa fa-users"></i>
              <span class="menu-title">Customer List</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="invoicelist">
              <i class="menu-icon fa fa-file-text-o"></i>
              <span class="menu-title">Invoice List</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="tracking">
              <i class="menu-icon fa fa-map-marker"></i>
              <span class="menu-title">User Tracking</span>
            </a>
          </li>
        </ul>
      </nav>