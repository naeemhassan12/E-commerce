<style>
.hero {
    height: 600px;
    overflow: hidden;
}

.hero video {
    height: 100%;
    object-fit: cover;
}
</style>

<section id="home" class="hero position-relative">
    <video autoplay muted loop playsinline class="w-100 h-100 position-absolute top-0 start-0 object-fit-cover">
        <source src="assets/image/e-commerce.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="overlay position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.5);"></div>
    <div class="text-center position-relative text-white" style="z-index: 2; padding: 150px 20px;">
        <h1 class="display-4 fw-bold">Welcome to My E-commerce</h1>
        <p class="lead">Best Products, Best Prices</p>
        <a href="#products" class="btn btn-primary btn-lg">Shop Now</a>
    </div>
</section>