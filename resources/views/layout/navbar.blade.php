<nav style="
  background: rgba(255, 255, 255, 0.7); 
  backdrop-filter: blur(15px); 
  -webkit-backdrop-filter: blur(15px); 
  border-radius: 15px; 
  border: 1px solid rgba(255, 255, 255, 0.3); 
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
  padding: 10px 20px; 
  display: flex; 
  align-items: center; 
  justify-content: space-between; 
  position: fixed; 
  top: 0; 
  width: calc(100% - 215px); 
  left: 215px; 
  z-index: 1000;
  margin-left: 0;
">
    <div style="display: flex; align-items: center;">
        <button style="background: none; border: none; color: #1E90FF; cursor: pointer; margin-right: 15px;" type="button" data-toggle="minimize">
            <span class="navbar-toggler-icon"></span>
        </button>
        <button style="background: none; border: none; color: #1E90FF; cursor: pointer;" type="button" data-toggle="offcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>
        <span style="color: #1E90FF; font-size: 18px; font-weight: 500; margin-left: 20px;">{{ Auth::user()->name }}</span>
    </div>

    <ul style="list-style: none; display: flex; align-items: center; margin: 0;">
        <li style="position: relative; margin-right: 20px;">
            <a href="#" id="notificationDropdown" data-toggle="dropdown" style="color: #FF4500; text-decoration: none; position: relative;">
                <i class="fas fa-bell" style="font-size: 18px;"></i>
                <span style="position: absolute; top: -5px; right: -10px; background: #FF4500; color: white; font-size: 10px; border-radius: 50%; padding: 2px 6px;">3</span>
            </a>
        </li>
        <li style="position: relative; margin-right: 20px;">
            <a href="#" id="messageDropdown" data-toggle="dropdown" style="color: #FFD700; text-decoration: none; position: relative;">
                <i class="fas fa-envelope" style="font-size: 18px;"></i>
                <span style="position: absolute; top: -5px; right: -10px; background: #FFD700; color: white; font-size: 10px; border-radius: 50%; padding: 2px 6px;">5</span>
            </a>
        </li>
        <li style="position: relative;">
            <a href="#" id="profileDropdown" data-toggle="dropdown" style="color: #1E90FF; text-decoration: none; display: flex; align-items: center;">
                <img src="profile-icon.png" alt="Profile" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 8px;">
                <span style="font-size: 14px; color: #1E90FF;">Admin</span>
            </a>
        </li>
    </ul>
</nav>
