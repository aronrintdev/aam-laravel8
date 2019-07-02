<li class="{{ Request::is('academies*') ? 'active' : '' }}">
    <a href="{!! route('academies.index') !!}"><i class="fa fa-edit"></i><span>Academies</span></a>
</li>

<li class="{{ Request::is('accounts*') ? 'active' : '' }}">
    <a href="{!! route('accounts.index') !!}"><i class="fa fa-edit"></i><span>Accounts</span></a>
</li>

<li class="{{ Request::is('swings*') ? 'active' : '' }}">
    <a href="{!! route('swings.index') !!}"><i class="fa fa-edit"></i><span>Swings</span></a>
</li>

