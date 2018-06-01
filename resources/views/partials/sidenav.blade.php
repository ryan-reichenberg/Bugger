<ul id="slide-out" class="side-nav fixed">
    <li>
        <ul class="collapsible collapsible-accordion">
            <li class="no-padding">
                <a class="collapsible-header" href="{{route('dashboard')}}"><i class="material-icons prefix">insert_chart</i>Dashboard</a>
                <div class="collapsible-body">
                    <ul>
                    </ul>
                </div>
            </li>
        </ul>
    </li>
    <li>
        <ul class="collapsible collapsible-accordion">
            <li class="no-padding">
                <a class="collapsible-header icon-after"> <i class="material-icons prefix">folder_open</i>Projects<i class="material-icons prefix"style="float:right;">arrow_drop_down</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{route('projects')}}"><i class="material-icons prefix">content_copy</i>View all</a></li>
                        @if(Auth::user()->manager)
                            <li><a href="{{route('projects.create')}}"><i class="material-icons prefix">add</i>Create new project</a></li>
                        @endif
                    </ul>
                </div>
            </li>
        </ul>
    </li>
    <li>
        <ul class="collapsible collapsible-accordion">
            <li class="no-padding">
                <a class="collapsible-header" href="#"><i class="material-icons prefix">settings</i>Settings</a>
                <div class="collapsible-body">
                    <ul>
                    </ul>
                </div>
            </li>
        </ul>
    </li>
</ul>