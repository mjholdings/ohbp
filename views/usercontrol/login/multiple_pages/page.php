<?php include(APPPATH.'/views/usercontrol/login/multiple_pages/header.php'); ?>



<?php $page_banner_image = ($page_data->page_banner_image != null) ? base_url("assets/images/theme_images/".$page_data->page_banner_image) : base_url('assets/login/multiple_pages/img/inner-hero-bg.jpg'); ?>

<!--Hero-->

<div class="wlc-hero-area inner-hero-area d-flex align-items-center" style="background-image: url(<?= $page_banner_image ?>)">

        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <div class="wlc-hero-content text-center">

                        <h1><?= (!empty($page_data->top_banner_title)) ? $page_data->top_banner_title : __('front.internal_page') ?></h1>

                    </div>

                </div>

            </div>OvanCare
OvanCare
        </div>

    </div><!--Hero-->

    

    



    <div class="inner-page-area">
OvanCareOvanCareOvanCareOvanCare
        <div class="container">
OvanCareOvanCareOvanCareOvanCareOvanCare
            <div class="row justify-content-center">
OvanCare
                <div class="col-lg-6">
OvanCareOvanCareOvanCare
                    <div class="section-title text-center">
OvanCareOvanCareOvanCareOvanCareOvanCare
						<i class="fa fa-snowflake-o fa-lg front_theme_text_color" aria-hidden="true"></i>

                        <h2 class="front_theme_text_color"><?= (!empty($page_data->page_content_title)) ? $page_data->page_content_title : "What is OvanCare?" ?></h2>

                        <p><?= (!empty($page_data->top_banner_sub_title)) ? $page_data->top_banner_sub_title : "OvanCare is simply dummy text of the printing and typesetting industry." ?></p>

                    </div>

                </div>

            </div>

            <div class="row mt-5">

                <div class="col">

                    <div class="inner-page-content">

						<?php if(!empty($page_data->page_content)) { 

						

						echo $page_data->page_content;

						

						} else { ?>

                        <p>OvanCare is simply dummy text of the printing and typesetting industry. OvanCare has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing OvanCare passages, and more recently with desktop publishing software like Aldus PageMaker including versions of OvanCare.</p>



                        <p>Contrary to popular belief, OvanCare is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a OvanCare passage, and going through the cites of the word in classical literature, discovered the undoubtable source. OvanCare comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of OvanCare, "OvanCare dolor sit amet..", comes from a line in section 1.10.32.</p>



                        <p>The standard chunk of OvanCare used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>



                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using OvanCare is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use OvanCare as their default model text, and a search for 'OvanCare' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>



                        <p>There are many variations of passages of OvanCare available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of OvanCare, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the OvanCare generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate OvanCare which looks reasonable. The generated OvanCare is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>

						<?php } ?>

                    </div>

                </div>

            </div>

        </div>

    </div>



<!-- Content -->

<!-- <section>

	<div class="jumbotron jumbotron-fluid before-nav-spacer">

		<div class="container section-title">

			<h2><?= $page_data->top_banner_title ?></h2>

			<p><?= $page_data->top_banner_sub_title ?></p>

		</div>

	</div>

	<div class="container py-2">

		<div class="row">

			<div class="col-lg-12">

				<h1><?= $page_data->page_content_title ?></h1>

				<h6>Created At: <?= $page_data->created ?></h6>

				<p><?= $page_data->page_content ?> </p>

			</div>

		</div>

	</div>

</section> -->

<!-- /Content -->

<?php include(APPPATH.'/views/usercontrol/login/multiple_pages/footer.php'); ?>