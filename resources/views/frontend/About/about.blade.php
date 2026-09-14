@extends('frontend.layouts.master')

@section('title')

@endsection

@section('css')

@endsection

@section('title_page1')

@endsection

@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="contact-us container">
            <div class="mw-930">
                <h2 class="page-title">من نحن</h2>
            </div>

            <div class="about-us__content pb-5 mb-5">
                <p class="mb-5">
                    <img loading="lazy" class="w-100 h-auto d-block"
                        src="{{asset('frontend/assets/images/about/about-1.jpg')}}" width="1410" height="550" alt="" />
                </p>
                <div class="mw-930">
                    <h3 class="mb-4">قصتنا</h3>
                    <p class="fs-6 fw-medium mb-4">نحن متجر إلكتروني متخصص في تقديم مجموعة متنوعة من المنتجات عالية الجودة،
                        ونسعى دائمًا إلى توفير تجربة تسوق سهلة ومميزة لعملائنا. نعمل على اختيار منتجاتنا بعناية
                        لنضمن لك أفضل جودة وأفضل قيمة مقابل السعر، مع الاهتمام بأدق التفاصيل لتلبية احتياجاتك وتوقعاتك.</p>
                    <p class="mb-4">منذ انطلاق متجرنا، كان هدفنا الأساسي هو بناء علاقة طويلة الأمد مع عملائنا من خلال تقديم
                        منتجات مميزة، وأسعار مناسبة، وخدمة عملاء موثوقة. نؤمن بأن التسوق الإلكتروني يجب أن يكون
                        بسيطًا وآمنًا ومريحًا، لذلك نعمل باستمرار على تطوير خدماتنا وتحسين تجربة المستخدم في جميع
                        مراحل التسوق، بداية من اختيار المنتج وحتى إتمام عملية الشراء واستلام الطلب.</p>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5 class="mb-3">رسالتنا</h5>
                            <p class="mb-3">تقديم منتجات عالية الجودة وخدمة متميزة تجعل تجربة التسوق الإلكتروني سهلة وموثوقة
                                وممتعة لكل عميل.</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-3">رؤيتنا</h5>
                            <p class="mb-3">أن نكون متجرًا إلكترونيًا موثوقًا ومفضلًا لدى عملائنا من خلال الجودة، والابتكار،
                                والاهتمام المستمر برضا العملاء.</p>
                        </div>
                    </div>
                </div>
                <div class="mw-930 d-lg-flex align-items-lg-center">
                    <div class="image-wrapper col-lg-6">
                        <img class="h-auto" loading="lazy" src="{{asset('frontend/assets/images/about/about-1.jpg')}}"
                            width="450" height="500" alt="">
                    </div>
                    <div class="content-wrapper col-lg-6 px-lg-4">
                        <h5 class="mb-3">متجرنا</h5>
                        <p>نحرص في متجرنا على تقديم تجربة تسوق متكاملة تجمع بين الجودة والسهولة والثقة. نوفر مجموعة
                            متنوعة من المنتجات التي تناسب احتياجات عملائنا المختلفة، مع الاهتمام بتقديم معلومات واضحة
                            عن كل منتج وأسعار مناسبة وخيارات تسوق مريحة. هدفنا هو أن تجد ما تبحث عنه بسهولة، وأن تحصل
                            على خدمة احترافية في كل خطوة من خطوات تجربة الشراء.</p>
                    </div>
                </div>
            </div>
        </section>


    </main>

@endsection

@section('scripts')

@endsection