
<div class="row">
 <div class="col-lg-3 col-md-3 col-sm-12">
    <div id="hidemenu" class="hidemenu sidebar-menu">
        <ul>
            @foreach($sidebarmenu as $category)
            <li><a href="{{url('category/'.$category->slug)}}">{{$category->name}} <i class="fa fa-caret-right"></i></a>
                <ul class="sidebar-submenu">
                    @foreach($category->subcategories as $subcategory)
                    <li><a href="{{url('subcategory/'.$subcategory->slug)}}">{{$subcategory->subcategoryName}}</a>
                        <ul class="sidebar-childmenu">
                            @foreach($subcategory->childcategories as $childcat)
                            <li><a href="{{url('products/'.$childcat->slug)}}">{{$childcat->childcategoryName}}</a>
                            </li>
                           @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>

            </li>
            @endforeach
        </ul> 
   </div>
</div>
</div>