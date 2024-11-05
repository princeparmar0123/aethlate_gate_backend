<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Main</h6>
                    <ul>
                        <li class="{{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}"><i data-feather="grid"></i><span>Dashboard</span></a>
                        </li>

                        {{-- <li class="{{ Route::currentRouteName() == 'parent.category.index' ? 'active' : '' }}"><a
                                href="{{ route('parent.category.index') }}"><i
                                    data-feather="codepen"></i><span>Category</span></a></li> --}}
                    </ul>
                </li>
                {{-- <li class="submenu-open">
                    <h6 class="submenu-hdr">Product-Section</h6>
                    <ul>
                        <li class="{{ Route::currentRouteName() == 'product.index' ? 'active' : '' }}"><a
                                href="{{ route('product.index') }}"><i data-feather="box"></i><span>Product</span></a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'product.create' ? 'active' : '' }}"><a
                                href="{{ route('product.create') }}"><i data-feather="plus-square"></i><span>Create
                                    Product</span></a></li>
                </li>

                <li class="submenu-open">
                    <h6 class="submenu-hdr">Blog-Section</h6>
                    <ul>
                        <li class="{{ Route::currentRouteName() == 'blog.index' ? 'active' : '' }}"><a
                                href="{{ route('blog.index') }}"><i style="margin-right:10px;"
                                    class="fa fa-tags"></i><span>Blog</span></a>
                        </li>

                        <li class="{{ Route::currentRouteName() == 'blog.create' ? 'active' : '' }}"><a
                                href="{{ route('blog.create') }}"><i data-feather="plus-square"></i><span>Create
                                    Blog</span></a></li>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Contacts-Section</h6>
                    <ul>
                        <li class="{{ Route::currentRouteName() == 'contact.index' ? 'active' : '' }}"><a
                                href="{{ route('contact.index') }}"><i style="margin-right:10px;"
                                    class="fa fa-address-book"></i><span>Contacts</span></a>
                        </li>
                        <li class="{{ Route::currentRouteName() == 'comment.index' ? 'active' : '' }}"><a
                                href="{{ route('comment.index') }}"><i style="margin-right:10px;"
                                    class="fa fa-comment"></i><span>Comments</span></a>
                        </li>
                </li> --}}
            </ul>
        </div>
    </div>
</div>
