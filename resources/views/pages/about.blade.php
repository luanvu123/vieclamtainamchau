@extends('layout')

@section('content')
<style>
    /* Services Section Styles */
.services {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    font-family: Arial, sans-serif;
}

/* Hero Section */
.hero-content {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    margin-bottom: 3rem;
}

.hero-content h1 {
    color: #ff0000;
    font-size: 2rem;
    text-align: center;
    margin-bottom: 2rem;
}

.about-us h2 {
    color: #4CAF50;
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

.about-us p {
    line-height: 1.6;
    color: #333;
}

/* Hero Image */
.hero-image {
    width: 100%;
    max-width: 800px;
    margin: 2rem auto;
}

.hero-image img {
    width: 100%;
    height: auto;
    border-radius: 8px;
}

/* Content Sections */
.services h2 {
    color: #4CAF50;
    font-size: 1.5rem;
    margin: 2rem 0 1rem;
}

.services p {
    line-height: 1.6;
    margin-bottom: 1.5rem;
    color: #333;
}

.services p.highlight {
    color: #4CAF50;
    font-weight: bold;
    font-size: 1.1rem;
}

/* Services List */
.services ul {
    list-style: none;
    padding: 0;
    margin: 2rem 0;
}

.services ul li {
    padding: 0.5rem 0;
    padding-left: 1.5rem;
    position: relative;
}

.services ul li:before {
    content: "•";
    color: #4CAF50;
    position: absolute;
    left: 0;
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    .services {
        padding: 1rem;
    }

    .hero-content h1 {
        font-size: 1.5rem;
    }

    .about-us h2,
    .services h2 {
        font-size: 1.3rem;
    }

    .services p,
    .services ul li {
        font-size: 0.95rem;
    }
}

@media screen and (max-width: 480px) {
    .hero-content h1 {
        font-size: 1.2rem;
    }

    .about-us h2,
    .services h2 {
        font-size: 1.1rem;
    }

    .services p,
    .services ul li {
        font-size: 0.9rem;
    }
}
</style>
    <section class="services">
        <div class="hero-content">
            <h1>Giới thiệu về Báo Online Việt Nam tại năm châu "vieclamnamchau.com"</h1>

            <div class="about-us">
                <h2>Chúng tôi là ai?</h2>
                <p>Những năm ý nghĩ làm một điều gì đó để chúng tôi giúp Cộng Đồng người Việt tại năm châu ngày một phát
                    triển vững mạnh. Chính vì thế Tin tin việc xin việc vieclamnamchau.com cung cấp thông tin và những việc
                    trọng thể về nhu cầu tìm kiếm việc làm nhà ở, sang nhượng business và dịch vụ cho cộng đồng trong được
                    đơn giản, nhanh gọn, dễ dàng hơn.</p>
            </div>
        </div>
        <div class="hero-image">
            <img src="{{ asset('frontend/about.png') }}" alt="Business professional with phone">
        </div>
        <h2>Chúng tôi có thể làm gì cho bạn</h2>

        <p class="highlight">Bạn đang tìm kiếm 1 công việc</p>
        <p>Bạn chưa tự tin vào khả năng tiếng anh của mình bạn muốn tìm công việc full-time, part time sau những giờ đi học.
            Đừng lo, chúng tôi luôn nỗ lực hết mình để đẩy dựng website Vieclamtainamchau.com trở thành kênh chuyên tin về
            Việc làm - Du học - Xuất khẩu lao động - Nhà ở & Dịch vụ cung cấp cho bạn và cộng đồng Việt nam, người Việc tại
            nầm châu, những thông tin hữu ích, công cụ tìm kiếm, cách bố trí thông minh giúp bạn có thể dễ dàng tìm kiếm
            được công việc mình mong muốn.</p>

        <p class="highlight">Bạn là chủ doanh nghiệp, shop, nhà hàng, muốn tìm kiếm nhân viên phù hợp</p>
        <p>Chúng tôi luôn đồng hành, giúp bạn đăng quảng cáo tìm thợ, cho thuê nhà, thuê phòng, sang nhượng business một
            cách nhanh nhất với mục chi phí rất rẻ kèm tới đa cho bạn bằng sự nhiệt tình, tận tâm, hỗ trợ khách hàng 24/7
            của chúng tôi.</p>

        <h2>Các dịch vụ của chúng tôi</h2>
        <ul>
            <li>Đăng tin quảng cáo VIP Post</li>
            <li>Đặt banner trên website, Group Facebook, Pin bài posting</li>
            <li>Viết bài nội dung về dịch vụ, sản phẩm, doanh nghiệp của bạn</li>
            <li>Lập, quản lý và phát triển Fanpage Facebook</li>
            <li>Đăng ký dịch vụ, doanh nghiệp của bạn trên Google Map(hỗ trợ làm SEO local)</li>
            <li>Thiết kế logo, Business card, bảng giá dịch vụ chuyên nghiệp</li>
            <li>Chạy quảng cáo Facebook, Google</li>
            <li>Xây dựng thư viện, đánh giá chiến lượng Marketing plan...</li>
        </ul>
    </section>
@endsection
