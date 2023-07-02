<nav class="navbar py-0 navbar-expand-lg navbar-light navbar-laravel" role="navigation" aria-label="main navigation">
    <div class="container div2" id="navbarBasicExample navbar-menu">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <style>
                #active {
                    background-color: #092F20;
                    padding: 10px;
                    border-radius: 4px;
                    color: white;
                }
            </style>
            @guest
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item" style="margin-left: 0">
                        <a class="nav-link" href="/" id="{{ Request::path() === '/' ? 'active': '' }}">Home</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" id="{{ Request::path() === 'login' ? 'active': '' }}" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            @else
                @if(Auth::user()->password_changed === 1)
                    <ul class="navbar-nav mr-auto">
                        <div class="navbar-start">
                            <a class="navbar-item" href="/dashboard" id="{{ Request::path() === 'dashboard' ? 'active': '' }}">
                                Live Situation
                            </a>
                            <a class="navbar-item" href="/level2" id="{{ Request::path() === 'level2' ? 'active': '' }}">
                                Performances
                            </a>
                            <a class="navbar-item" href="/level3" id="{{ Request::path() === 'level3' ? 'active': '' }}">
                                Customers
                            </a>
                            @if(Auth::user()->role === 'admin')
                                <div class="navbar-item has-dropdown is-hoverable">
                                    <a class="navbar-link" >
                                        Admin
                                    </a>
                                    <div class="navbar-dropdown has-shadow">
                                        <a class="navbar-item" href="/routes" id="{{ Request::path() === 'routes' ? 'active': '' }}">
                                            Tours
                                        </a>
                                        <a class="navbar-item" href="/users" id="{{ Request::path() === 'users' ? 'active': '' }}">
                                            Users
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item control dropdown" id="dropdown">
                            <div id="csrf-token" data-token="{{ csrf_token() }}"></div>
                            <div class="dropdown-trigger">
                                <button class="button" aria-haspopup="true" aria-controls="dropdown-menu" id="dropdown-button">
                                    Notifications
                                    <span class="icon is-small">
                                    <i class="fas fa-angle-down" aria-hidden="true"></i>
                                </span>
                                </button>
                            </div>
                            <div class="dropdown-menu" id="dropdown-menu" role="menu">
                                <div class="dropdown-content" style="overflow:scroll; height:40em;"id="notificationlist">
                                    @foreach($currentUser->unreadNotifications as $notification)
                                        <div id="notification-{{$notification->id}}">
                                            <div>
                                                <button name="readbutton" id="{{$notification->id}}" class="btn read-button">Read</button>
                                            </div>
                                            <p class="dropdown-item notification-item" data-notification-id="{{$notification->id}}">
                                        <span>
                                            {{$notification->data['client']}}
                                        </span>
                                                {{ $notification->data['message'] }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        <li>
                            <a class="button" href="{{ route('APIInsertDataFix.storeCustomer') }}" style="border: 2px solid grey; box-shadow: rgba(0,0,0,0.35) 0px 5px 15px; margin-right: 4px; margin-left: 8px">
                                TestAPI
                            </a>
                        </li>
                        <li class="nav-item control">
                            <a class="navbar-item is-active" href="{{ route('profile') }}" id="{{ Request::path() === 'profile' ? 'active': '' }}">
                                Profile
                            </a>
                        </li>
                        <li class="nav-item control">
                            <a class="navbar-item is-active" href="{{ route('logout') }}">
                                Logout
                            </a>
                        </li>
                    </ul>
                @endif
            @endguest
        </div>
    </div>
</nav>
<script>
    // Function to mark notification as read
    async function markNotificationAsRead(id) {
        const url = window.location.origin + "/notifications/" + id + "/read";
        const csrfToken = document.getElementById('csrf-token').getAttribute('data-token');
        const settings = {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ title: 'Fetch PUT Request Example' })
        };
        try {
            const fetchResponse = await fetch(url);
            const data = await fetchResponse.json();
            console.log(data);
            // Remove the notification element from the dropdown
            return data;
        } catch (e) {
            return e;
        }
    }

    const list = document.getElementById("notificationlist");

    list.addEventListener('click', function(event) {
        removeNotification(event.target);
    });

    function removeNotification(element) {
        id = element.id;
        const divToRemove = document.getElementById('notification-' + id);
        divToRemove.remove();
    }
    // Toggle dropdown menu when the dropdown button is clicked
    const dropdownButton = document.getElementById("dropdown-button");
    dropdownButton.addEventListener("click", () => {
        const dropdown = document.getElementById("dropdown");
        dropdown.classList.toggle("is-active");
    });
</script>
