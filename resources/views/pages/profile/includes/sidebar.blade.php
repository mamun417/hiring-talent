<div class="card shadow mb-4 topBorder">
    <div class="card-body">
        <table>
            <tr>
                <td class="pr-3">
                    <img src="{{ isset(auth()->user()->image) && auth()->user()->image->url ? auth()->user()->image->url : asset('backend/img/profile/man.svg') }}" class="rounded-circle" alt="Cinque Terre" width="48" height="48">
                </td>
                <td>
                    {{ @$user->name }}
                </td>
            </tr>
        </table>
    </div>
</div>
<ul class="list-group shadow mb-4">
    <li class="list-group-item"><a href="{{ route('user.profile') }}">My Profile</a></li>
    <li class="list-group-item"><a href="{{ route('user.talent', @$user->id) }}">Talent</a></li>
    <li class="list-group-item"><a href="{{ Auth::user()->referral_link }}" target="_blank">Referral Link</a></li>
    <li class="list-group-item">
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
            <span>Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
</ul>
