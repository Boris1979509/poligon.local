<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link{{ $page !== '' ? ' active' : '' }}"
           href="{{ route('admin.home') }}">{{ __(ucfirst($page)) }}</a>
    </li>
</ul>
