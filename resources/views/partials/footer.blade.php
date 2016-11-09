
</div>
</div>
<div id="footer">

    <div class="container hidden-xs">
        <div class="row">
            <div class="col-xs-8">
                <p class="text-muted credit">
                    &copy; <a href="/">yiXinyiyi</a> 2016. allRights reserved.
                </p>
            </div>
            <div class="col-xs-4">
                <p class="text-muted credit pull-right">

                </p>
            </div>
        </div>
    </div>
    {{--<div class="container visible-xs">--}}
        {{--<p class="text-muted credit">--}}
            {{--&copy; <a href="https://github.com/GrahamCampbell">yiXinyiyi</a> 2016. All rights reserved.--}}
        {{--</p>--}}
    {{--</div>--}}
</div>

{{--<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>--}}
{{--<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-timeago/1.4.1/jquery.timeago.min.js"></script>--}}

{{--<script type="text/javascript" src="/js/bootstrap/twitter-bootstrap.3.3.2.min.js"></script>--}}

{{--<script type="text/javascript" src="{{ asset('assets/scripts/cms-main.js') }}"></script>--}}
@section('js')
@show
@if (Config::get('analytics.google'))
    @include('partials.analytics')
@endif
