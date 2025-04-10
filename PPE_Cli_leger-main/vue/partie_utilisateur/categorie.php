<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Services - Matériaux de Construction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- En-tête -->
    <div class="py-5 position-relative" style="background: linear-gradient(135deg, #1a1a1a 0%, #363636 100%);">
        <div class="container py-5">
            <div class="text-center">
                <h1 class="display-4 text-light">Nos Services</h1>
                <p class="lead text-light mb-4">Des solutions complètes pour vos projets de construction</p>
            </div>
        </div>
    </div>

    <main class="container my-5">
        <section class="services-section py-5">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100 shadow-sm hover-card">
                        <div class="card-body text-center">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-home fa-3x text-danger"></i>
                            </div>
                            <h5 class="card-title">Toiture et Couverture</h5>
                            <ul class="list-unstyled text-start">
                                <li class="border-bottom py-2">Tuiles et ardoises</li>
                                <li class="border-bottom py-2">Gouttières</li>
                                <li class="border-bottom py-2">Isolation toiture</li>
                                <li class="py-2">Membranes d'étanchéité</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card h-100 shadow-sm hover-card">
                        <div class="card-body text-center">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-faucet fa-3x text-success"></i>
                            </div>
                            <h5 class="card-title">Plomberie & Sanitaire</h5>
                            <ul class="list-unstyled text-start">
                                <li class="border-bottom py-2">Tuyauterie et raccords</li>
                                <li class="border-bottom py-2">Robinetterie</li>
                                <li class="border-bottom py-2">Évacuation</li>
                                <li class="py-2">Équipements sanitaires</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="card h-100 shadow-sm hover-card">
                        <div class="card-body text-center">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-plug fa-3x text-warning"></i>
                            </div>
                            <h5 class="card-title">Électricité</h5>
                            <ul class="list-unstyled text-start">
                                <li class="border-bottom py-2">Câbles et gaines</li>
                                <li class="border-bottom py-2">Tableaux électriques</li>
                                <li class="border-bottom py-2">Prises et interrupteurs</li>
                                <li class="py-2">Éclairage technique</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="card h-100 shadow-sm hover-card">
                        <div class="card-body text-center">
                            <div class="feature-icon mb-3">
                                <i class="fas fa-paint-roller fa-3x text-primary"></i>
                            </div>
                            <h5 class="card-title">Peinture & Décoration</h5>
                            <ul class="list-unstyled text-start">
                                <li class="border-bottom py-2">Peintures intérieures</li>
                                <li class="border-bottom py-2">Revêtements muraux</li>
                                <li class="border-bottom py-2">Outillage peinture</li>
                                <li class="py-2">Enduits décoratifs</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="contact-section text-center py-5 mt-5" style="background: linear-gradient(135deg, #1a1a1a 0%, #363636 100%); border-radius: 15px;">
            <div class="container py-4">
                <h2 class="text-light">Besoin d'un conseil ?</h2>
                <p class="text-light mb-4">Nos experts sont à votre disposition pour vous guider dans votre projet</p>
                <button class="btn btn-warning btn-lg">
                    <i class="fas fa-envelope me-2"></i> Contactez-nous
                </button>
            </div>
        </section>
    </main>

    <style>
        .hover-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
        .feature-icon {
            transition: transform 0.3s ease;
        }
        .hover-card:hover .feature-icon {
            transform: scale(1.1);
        }
        .card {
            border: none;
            border-radius: 10px;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
