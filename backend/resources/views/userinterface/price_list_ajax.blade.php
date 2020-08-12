<div class="row">
    <div class="tab_title col-md-11 offset-md-1">
        <p><strong>Price List</strong></p>
    </div>
    @if(count($products)>0)
    @forelse($products as $key => $product)
    <div class="col-md-5 offset-md-1">
        <div class="price-list-box">
            <ul>
                <li>
                    <div class="price-list-data">
                        <span>Apron - Press Only</span>
                        <span>£3.00</span>
                    </div>
                </li>

                <li>
                    <div class="price-list-data">
                        <span>Blanket - Press Only</span>
                        <span>£15.00</span>
                    </div>
                </li>

                <li>
                    <div class="price-list-data">
                        <span>Blouse - Press Only</span>
                        <span>£3.50</span>
                    </div>
                </li>

                <li>
                    <div class="price-list-data">
                        <span>Child’d Dress - Press Only </span>
                        <span>£4.75</span>
                    </div>
                </li>

                <li>
                    <div class="price-list-data">
                        <span>Child’s Item - Press Only</span>
                        <span>£2.50</span>
                    </div>
                </li>


                <li>
                    <div class="price-list-data">
                        <span>Child’s Jacket - Press Only</span>
                        <span>£2.95</span>
                    </div>
                </li>


                <li>
                    <div class="price-list-data">
                        <span>Child’s Jacket - Press Only</span>
                        <span>£2.50</span>
                    </div>
                </li>

                <li>
                    <div class="price-list-data">
                        <span>Child’s Trousers - Press Only</span>
                        <span>£1.80</span>
                    </div>
                </li>
            </ul>
        </div>

    </div>
    @endforelse
    @endif
    <!-- <div class="col-md-5 ">
        <div class="price-list-box">
            <ul>
                <li>
                    <div class="price-list-data">
                        <span>Napkin - Press Only</span>
                        <span>£1.00</span>
                    </div>
                </li>

                <li>
                    <div class="price-list-data">
                        <span>Napkin - Press Only</span>
                        <span>£6.90</span>
                    </div>
                </li>

                <li>
                    <div class="price-list-data">
                        <span>Pashmina</span>
                        <span>£5.80</span>
                    </div>
                </li>

                <li>
                    <div class="price-list-data">
                        <span>Pashmina - Press Only </span>
                        <span>£6.00</span>
                    </div>
                </li>

                <li>
                    <div class="price-list-data">
                        <span>Pillowcase - Press Only</span>
                        <span>£1.60</span>
                    </div>
                </li>

                <li>
                    <div class="price-list-data">
                        <span>Polo Shirt - Press Only</span>
                        <span>£3.00</span>
                    </div>
                </li>


                <li>
                    <div class="price-list-data">
                        <span>Pyjama Bottoms - Press Only</span>
                        <span>£3.00</span>
                    </div>
                </li>

                <li>
                    <div class="price-list-data">
                        <span>Pyjama Top - Press Only</span>
                        <span>£3.00</span>
                    </div>
                </li>

            </ul>
        </div>
    </div> -->
    <div class="col-md-12 text-center find-looking-wrap">
        <div class="title-heading">
            <h3>CAN’T FIND WHAT YOU’RE LOOKING FOR?</h3>
            <p>If you have an item you would like us to take care of but can't see it listed please contact us to clarify the price.</p> <br />

            <p>The Minimum order is £15 you can give us fewer items and the order will be rounded up to £15. Collection and Delivery is FREE, a supplement of £10 will apply if you are not in for a collection or delivery.
            </p>
        </div>
    </div>
</div>
