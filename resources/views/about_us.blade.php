@extends('main')
@section('body')

<div class="container shadow clearfix" style="margin-bottom: 200px;margin-top: 50px;">
    <div style="text-align: center;">
        <img style="margin:10px 0 0 0;" src="/assets/images/about-us.svg" alt="">
    </div>
    <div style="display: flex;padding-top: 40px;">
        <div style="flex-basis: 40%;">
            <img width="420px" height="250px" style="margin-bottom: 10px; border-radius: 10px;" src="/assets/images/about-us.jpg" alt="">
        </div>
        <div style="flex-basis: 60%;">
            <p style="color:black;font-size: 20px;user-select: none;"> T4Tek chính là nơi khởi đầu cho những thành công của các kỹ sư CNTT trong tương lai, cung cấp và đào tạo nguồn nhân lực IT chất lượng cao cho các dự án lớn trên toàn cầu.​
                <br>
                <br>
                Chúng tôi luôn hướng tới giải pháp tối ưu cho doanh nghiệp của bạn. Đặc biệt tư vấn triển khai chuyển đổi số cho doanh nghiệp, mang đến tối ưu vận hành, tối đa lợi nhuận với chi phí hợp lý nhất.
            </p>
        </div>
    </div>
    <style>
        .khung {
            position: relative;
            width: 200px;
            height: 300px;
            transition: color 0.4 linear;
            border-radius: 20px;
            box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.25);
            margin-bottom: 50px;
        }

        .khung-nho {
            background-size: cover;
            width: 70%;
            height: 50%;
            position: absolute;
            display: flex;
            top: 100px;
            left: 28px;
            border-radius: 20px;
            box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.25);
        }

        .text-chu {
            position: absolute;
            color: #fff;
            width: 100%;
            height: 260px;
            padding-top: 10px;
            padding-left: 10px;
            padding-right: 10px;
            visibility: hidden;
            user-select: none;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 15px;
        }

        .khung::before {
            content: "";
            position: absolute;
            background: #0000002a;
            z-index: -1;
            bottom: 0;
            left: 0;
            transition: 0.3s;
            width: 100%;
            height: 0%;
            border-radius: 20px;
        }

        .khung:hover::before {
            height: 80%;
        }

        .khung:hover .khung-nho {
            visibility: hidden;
        }

        .chu {
            font-size: 25px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-weight: bold;
            text-align: center;
            padding-top: 5px;
            user-select: none;
            color: black
        }

        .khung:hover .khung-nho {
            display: none;
        }

        .khung:hover .text-chu {
            visibility: visible;
            color: black;
        }

        .tong {
            display: flex;
            margin: 0 auto;
            justify-content: space-around;
        }
    </style>
    <div>
        <h3 style="text-align: center;margin-top: 40px;margin-bottom: 40px;user-select: none;">Lĩnh vực kinh doanh</h3>
        <section class="tong">
            <div class="khung border">
                <p class="chu">Tư vấn</p>
                <div class="khung-nho border" style=" background-image: url('https://docosan.com/blog/wp-content/uploads/2021/06/tu-van-tam-ly-online-min-e1623150090275.jpg');">
                </div>
                <p class="text-chu">
                    Tư vấn chuyển đổi số doanh nghiệp
                </p>
            </div>
            <div class="khung border">
                <p class="chu">Triển khai</p>
                <div class="khung-nho border" style=" background-image: url('https://www.avepoint.com/blog/wp-content/uploads/2020/04/file-sharing-via-internet-vector-id1157891945.jpg');">
                </div>
                <p class="text-chu">
                    Triển khai hệ thống vận hành doanh nghiệp: ERP, CRM, HRM, Marketing, Elearning, …
                </p>
            </div>
            <div class="khung border">
                <p class="chu">Hosting</p>
                <div class="khung-nho border" style=" background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQa_hDzT75S1cFwEwkC_T5PTTRKXz9OUr1jES-b2-dIuRrLYZrjkw0J8Wla_CJ9RFof-O0&usqp=CAU');">
                </div>
                <p class="text-chu">
                    Hosting: domain, website, Email doanh nghiệp
                </p>
            </div>
            <div class="khung border">
                <p class="chu">Dịch vụ số</p>
                <div class="khung-nho border" style=" background-image: url('https://chuyendoiso.thanhhoa.gov.vn/upload/images/2021/07/ngan-hang-cds-1.jpeg');">
                </div>
                <p class="text-chu">
                    Dịch vụ số: Chữ ký số, Hoá đơn điện tử, tổng đài điện tử …
                </p>
            </div>
        </section>
    </div>
</div>

@endsection