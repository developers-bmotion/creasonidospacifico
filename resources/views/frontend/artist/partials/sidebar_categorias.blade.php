
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
          
        </div>
    </div>
