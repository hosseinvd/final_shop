<div class="col-lg-9 col-md-9 ">
    <div class="mainmenu bg-color-4 ">
        <nav>
            <ul>
                <li class="active"><a href="">پروفایل من</a>
                    <ul>
                        <li><a href={{route('u_user-profile')}}>پروفایل من</a></li>
                        <li><a href={{route('enter_user_info')}}>ویرایش اطلاعات</a></li>
                        <li><a href={{route('products')}}>بازگشت به فروشگاه</a></li>
                    </ul>
                </li>
                <li><a href={{route('user-orders')}}>سفارشات من </a></li>
                <li><a href={{route('user-comments')}}>نظرات من</a></li>
                <li><a href="#">امور مالی</a>
                    <ul>
                        <li><a href={{route('user-bank_account')}}>گزارش مالی</a></li>
                        <li><a href="cart.html">صفحه سبد خرید</a></li>
                    </ul>
                </li>
                <li><a href="about.html">درباره ما</a></li>
            </ul>

        </nav>
    </div>
</div>