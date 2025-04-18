    </main>

    <footer class="bg-light mt-5 py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><?= SITE_NAME ?></h5>
                    <p>Une plateforme conçue pour faciliter l'accès aux soins médicaux pour les personnes handicapées.</p>
                </div>
                <div class="col-md-4">
                    <h5>Liens rapides</h5>
                    <ul class="list-unstyled">
                        <li><a href="/">Accueil</a></li>
                        <li><a href="/search">Recherche</a></li>
                        <li><a href="/facilities">Établissements</a></li>
                        <li><a href="/doctors">Médecins</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact</h5>
                    <address>
                        <p><i class="bi bi-envelope"></i> contact@soinsaccessibles.com</p>
                        <p><i class="bi bi-telephone"></i> +33 1 23 45 67 89</p>
                    </address>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy; <?= date('Y') ?> <?= SITE_NAME ?>. Tous droits réservés.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Google Maps API (only load if needed) -->
    <?php $needsMap = isset($needsMap) && $needsMap; ?>
    <?php if ($needsMap && GOOGLE_MAPS_API_KEY): ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?= GOOGLE_MAPS_API_KEY ?>&libraries=places&callback=initMap" async defer></script>
    <?php endif; ?>
    
    <!-- Custom JavaScript -->
    <script src="/js/script.js"></script>
</body>
</html>
