<!--footer frea start-->
<div class="footer pb-3">
    <div class="container">
        <div class="footer-area text-center">
            <h2>CONTACT INFORMATION</h2>
        </div>
        <div class="footer-section">
            <div class="row">
                <div class="col-md-4 mb-4 mb-sm-2 text-center">
                    <h4>Address</h4>
                    <p class="mb-0">{{ @$globalContactInfo->address }}</p>
                </div>

                <div class="col-md-4 mb-4 mb-sm-2 text-center ">
                    <h4>Mobile Number</h4>
                    <p class="mb-0">{{ @$globalContactInfo->phone_1 }}</p>
                    <p class="mb-0">{{ @$globalContactInfo->phone_2 }}</p>
                </div>

                <div class="col-md-4 mb-4 mb-sm-2 text-center">
                    <h4>Email</h4>
                    <p class="mb-0"> {{ @$globalContactInfo->email }}</p>
                    {{--<p class="mb-0">Fax: {{ @$globalContactInfo->fax }}</p>--}}
                </div>
            </div>
        </div>
        <p class="text-center my-0">{{ config('app.name') }} © {{ date('Y') }} All rights reserved.</p>
    </div>
</div>
