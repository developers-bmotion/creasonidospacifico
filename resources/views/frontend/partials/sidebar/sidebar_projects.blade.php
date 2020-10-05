<div class="col-md-12 col-lg-4">
    <!-- sidebar content -->
    <div class="xs-sidebar-content">
        <div class="sidebar sidebar-right" id="sidebar">
            <div class="widget widget_categories xs-single-sidebar border xs-content-padding">
                <h3 class="widget-title xs-widget-title">{{ __('categorias') }}</h3>
                <ul class="xs-side-bar-list xs-font-alt">
                    @forelse($categories as $category)
                    <li><a href="{{ route('categories.show',$category->slug) }}"><span class="text-left">{{ $category->category }}</span><span
                                    class="text-right">({{ \App\Project::countbycategories($category->id)}})</span></a>
                    </li>
                    @empty
                        <h1>Ninguna Categoria</h1>
                    @endforelse
                </ul>
            </div>
            <div class="widget widget_call_to_action xs-single-sidebar">
                <div class="xs-call-to-action-content text-center xs-content-padding"
                     style="background-image: url(assets/images/call-to-action-img.jpg);">
                    <div class="xs-mb-40">
                        <img src="assets/images/call-to-action-icon.png" alt="">
                    </div>
                    <h3 class="color-white xs-mb-30">{{ __('Buscando') }}<strong
                                class="d-block">Caza talentos</strong>
                    </h3>
                    <div class="post-footer">
                        <a href="blog-details.html" class="xs-btn round-btn green-btn">Contactanos</a>
                    </div>
                    <div class="xs-solid-overlay xs-bg-navy-blue"></div>
                </div>
            </div>

        </div>
    </div>
</div>