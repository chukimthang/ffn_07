<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="{!! route('admin.categories.index') !!}">
                    <i class="fa fa-bar-chart-o fa-fw"></i>
                    @lang('admin.category')
                </a>
                <a href="{!! route('admin.news.index') !!}">
                    <i class="fa fa-bar-chart-o fa-fw"></i>
                    @lang('admin.news')
                </a>
                <a href="{!! route('admin.country.index') !!}">
                    <i class="fa fa-bar-chart-o fa-fw"></i>
                    @lang('admin.country')
                </a>
                <a href="{!! route('admin.league.index') !!}">
                    <i class="fa fa-bar-chart-o fa-fw"></i>
                    @lang('admin.league')
                </a>
                <a href="{!! route('admin.league_season.index') !!}">
                    <i class="fa fa-bar-chart-o fa-fw"></i>
                     @lang('admin.league_season')
                </a>
                <a href="{!! route('admin.teams.index') !!}">
                    <i class="fa fa-bar-chart-o fa-fw"></i>
                    @lang('admin.team')
                </a>
                <a href="{!! route('admin.player.index') !!}">
                    <i class="fa fa-bar-chart-o fa-fw"></i>
                    @lang('admin.player')
                </a>
                <a href="{!! route('admin.match.index') !!}">
                    <i class="fa fa-bar-chart-o fa-fw"></i>
                    @lang('admin.match')
                </a>
                <a href="{!! route('admin.team_achievement.index') !!}">
                    <i class="fa fa-bar-chart-o fa-fw"></i>
                    @lang('admin.team_achievement')
                </a>
                <a href="{!! route('admin.rank.index') !!}">
                    <i class="fa fa-bar-chart-o fa-fw"></i>
                    @lang('admin.rank')
                </a>
            </li>
        </ul>
    </div>
</div>
