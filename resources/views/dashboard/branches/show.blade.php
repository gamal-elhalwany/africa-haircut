@extends('dashboard.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{asset(env('App_Design_Url').'/Design/css/branches/main.css')}}">
@endpush
@section('title','تفاصيل الفرع')

@section('body')
    <div class="body">
       <div class="branch-details-container">
           <div class="branch-details-head">
                   <a class="btn btn-info" href="{{route('dashboard.branches.index')}}">
                       <i style="vertical-align: middle" class="fa-solid fa-backward"></i>
                       رجوع
                   </a>
           </div>

           <div class="branch-details-content">
               <div class="branch-details">
                    @foreach($FindBranchID as $Branch)
                        <div class="branch">
                            <div class="branch-name">
                               <p  class="alert alert-primary">{{$Branch->name}} </p>
                            </div>

                            @if($Branch->users->count() > 0)
                                <div class="branch-users">
                                    <p>موظفين الفرع</p>
                                    <ol>
                                      @foreach($Branch->users as $users)
                                                <li>{{$users->name}}</li>
                                      @endforeach
                                    </ol>
                                </div>
                            @endif


                            <div class="branch-store-products">

                                <div class="branch-store-products-title">
                                    <p>منتجات وخدمات الفرع</p>
                                </div>

                                <table class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">اسم المنتج</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($Branch->products as $products)
                                        <tr>
                                            <td>{{$products->name}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>



                            </div>

                        </div>


                    @endforeach
               </div>
           </div>
       </div>
    </div>
@endsection
