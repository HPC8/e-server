<!-- this footer is shown in device width above `sm` -->
<footer class="footer d-none d-sm-block">
    <div class="footer-inner">
        <div class="h-100 pt-3 border-t-1 brc-secondary-l3 bgc-white">
            <small>
                ศูนย์อนามัยที่ 8 อุดรธานี | กรมอนามัย | กระทรวงสาธารณสุข
                <p>© Copyright <?= date("Y")+543;?>, ICT ศูนย์อนามัยที่ 8 อุดรธานี</p></small>
        </div>
    </div><!-- .footer-inner -->
</footer>

<!-- this footer is shown in mobile devices below `sm` -->
<footer class="d-sm-none footer-sm footer-fixed">
    <div class="footer-inner">
        <div class="btn-group d-flex h-100 mx-0 navbar-teal px-2 py-15 shadow-lg">
            <button class="btn btn-outline-white btn-h-outline-white btn-a-outline-white active border-0 radius-round px-4 mx-2">
                <i class="fa fa-home text-120"></i>
                Home
            </button>

            <button class="btn btn-outline-white btn-h-outline-white btn-a-outline-white border-0 radius-round">
                <i class="fa fa-plus-circle opacity-1 text-120"></i>
            </button>

            <button data-toggle="collapse" data-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle navbar search" class="btn btn-outline-white btn-h-outline-white btn-a-outline-white border-0 radius-round">
                <i class="fa fa-search opacity-1 text-120"></i>
            </button>

            <button class="btn btn-outline-white btn-h-outline-white btn-a-outline-white border-0 mr-0 radius-round">
                <span class="pos-rel">
                    <i class="fa fa-bell opacity-1 text-120"></i>
                    <span class="badge badge-dot bgc-yellow-m1 position-tr mt-n1 mr-n2px"></span>
                </span>
            </button>
        </div>
    </div>
</footer>