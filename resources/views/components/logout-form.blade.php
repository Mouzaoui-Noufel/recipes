<form method="POST" action="{{ route('user.logout') }}">
    @csrf
    <button type="submit" class="btn btn-link">Logout</button>
</form>
