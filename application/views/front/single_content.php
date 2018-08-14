<div class="ct-site--map ct-u-backgroundGradient">
    <div class="container">
        <div class="ct-u-displayTableVertical text-capitalize">
            <div class="ct-u-displayTableCell">
                <span class="ct-u-textBig">
                    Blog
                </span>
            </div>
            <div class="ct-u-displayTableCell text-right">
                <span class="ct-u-textNormal ct-u-textItalic">
                    <a href="index.html">Home</a> / <a href="blog.html">Blog</a>
                </span>
            </div>
        </div>
    </div>
</div>
<section class="ct-u-paddingBoth100 ct-blog" itemscope itemtype="http://schema.org/Blog">
    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <article itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting" class="ct-article">
                    <div class="ct-article-media">
                        <img itemprop="image" src="<?= base_url(); ?>front/assets/images/demo-content/blog-post1.jpg"
                             alt="blog-post">
                    </div>
                    <div class="ct-article-title">
                        <a itemprop="url" href="blog-single.html"><h4>Lorem ipsum dolor sit amet, consectetuer
                                adipiscing elit .</h4></a>
                    </div>
                    <ul class="list-unstyled list-inline ct-article-meta">
                        <li class="ct-article-author"><a itemprop="url" href="blog-single.html"><i
                                    class="fa fa-pencil-square-o"></i>by <span itemprop="author">Mohamed</span></a></li>
                        <li itemprop="dateCreated" class="ct-article-date"><i class="fa fa-clock-o"></i>May 23,2014</li>
                        <li class="ct-article-comments"><a itemprop="url" href="blog-single.html"><i
                                    class="fa fa-comments-o"></i><span itemprop="commentCount">29</span> Comments</a>
                        </li>
                    </ul>
                    <div itemprop="text" class="ct-article-description">
                        <p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                            Aenean massa. Cum so
                            ntesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla
                            vel, aliquet nec, vulputa
                            te eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum
                            felis eu pede mollis pretiu
                            Integer tincidunt.
                        </p>
                    </div>
                </article>

            </div>
            <?php include('right_sidebar.php'); ?>
        </div>
    </div>
</section>