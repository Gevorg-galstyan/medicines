<nav id="sidebar">


    <ul class="list-unstyled components">
        <li class="{{Request::url() == route('manufacturer.index') ? 'active' : ''}}">
            <a href="{{route('manufacturer.index')}}" >Manufacturer</a>
        </li>
        <li class="{{Request::url() == route('type.index') ? 'active' : ''}}">
            <a href="{{route('type.index')}}">Type</a>
        </li>
        <li class="{{Request::url() == route('tablet.index') ? 'active' : ''}}">
            <a href="{{route('tablet.index')}}">Tablet</a>
        </li>
        <li class="{{Request::url() == route('watermark.index') ? 'active' : ''}}">
            <a href="{{route('watermark.index')}}">Watermark</a>
        </li>

    </ul>

</nav>
