<x-site>
    <x-site.breadcrumbs title="Checkout"/>
    <!-- Shop Checkouts Content -->
    <section class="shop-checkouts pt0">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-4 m-auto">
                    <div class="main-title text-center mb50">
                        <h2 class="title">Checkout</h2>
                    </div>
                </div>
            </div>
            <div class="checkout_form style2">
                <div class="checkout_coupon ui_kit_button">
                    <form class="form2" x-data x-submit action="{{ route('api.orders.store') }}">
                        <div class="row">
                            <div class="col-lg-7 order_sidebar_widget">
                                @guest()
                                    <div class="main-title mb50">
                                        <p>
                                            Returning customer?
                                            <a class="signin-filter-btn" href="#" style="color:#0d6efd;">
                                                Click here to login
                                            </a>
                                        </p>
                                    </div>
                                @endguest
                                <h4 class="title mb20">Billing details</h4>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label" for="first_name">First Name *</label>
                                            <input class="form-control" name="first_name" value="{{ user('first_name') }}"
                                                   @disabled(auth()->check()) id="first_name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label" for="last_name">Last Name *</label>
                                            <input class="form-control" name="last_name" value="{{ user('last_name') }}"
                                                   @disabled(auth()->check()) id="last_name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label" for="phone">Phone Number *</label>
                                            <input class="form-control" name="phone" type="number" value="{{ user('phone') }}"
                                                   @disabled(auth()->check()) id="phone">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label" for="email">Your Email</label>
                                            <input class="form-control" name="email" type="email" value="{{ user('email') }}"
                                                   @disabled(auth()->check()) id="email">
                                        </div>
                                    </div>
                                    <div class="accordion" id="deliveryType">
                                        <div class="accordion-item border-0">
                                            <div class="accordion-header" id="headingOne">
                                                <label class="accordion-button p-0 pe-3 bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <input id="choose-delivery" name="delivery_type" type="radio" value="delivery" checked/>
                                                    Deliver to my address
                                                </label>
                                            </div>
                                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#deliveryType">
                                                <div class="accordion-body">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="address">Delivery Address *</label>
                                                            <input class="form-control mb10" name="delivery_address" value="{{ user('address') }}" id="address">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item border-0">
                                            <div class="accordion-header" id="headingTwo">
                                                <label class="accordion-button collapsed p-0 pe-3 bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                    <input name="delivery_type" type="radio" value="pickup"/>
                                                    Pickup at Our Shop
                                                </label>
                                            </div>
                                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#deliveryType">
                                                <div class="accordion-body">
                                                    <div class="pm_details">
                                                        <span class="h5">Pickup at any of our shops closest to you. </span>
                                                        <a href="{{ route('stores') }}" target="_blank">Click here to check out our available addresses. </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group mb0 mt40">
                                            <label class="form-label" for="notes">Order notes (optional)</label>
                                            <textarea class="form-control" name="notes"  rows="1" id="notes"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="order_sidebar_widget checkout_page mb30 mb30">
                                    <h4 class="title">Your Order</h4>
                                    <ul>
                                        @foreach(cart()->products as $product)
                                            <li class="subtitle"><p class="product_name_qnt">{{ $product->name }} x&nbsp;{{ $product->quantity }} </p><span class="price">₦{{ number_format($product->price * $product->quantity) }}</span></li>
                                        @endforeach
                                        <li class="subtitle"><p>Sub Total <span class="float-end totals">₦{{ number_format(cart()->amount()) }}</span></p></li>
                                        <li class="subtitle"><p>Delivery <span class="float-end totals">Free</span></p></li>
                                        <li class="subtitle"><p>Total <span class="float-end totals">₦{{ number_format(cart()->amount()) }}</span></p></li>
                                    </ul>
                                </div>
                                @if(cart()->products->isNotEmpty())
                                    <div class="ui_kit_button payment_widget_btn">
                                        <button type="submit" class="btn btn-thm btn-block mb0">Place Order</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-site>
