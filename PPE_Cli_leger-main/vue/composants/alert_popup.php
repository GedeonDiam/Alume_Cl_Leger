<?php
/**
 * Composant pour afficher une popup de message
 * Utilisé pour les notifications, alertes et messages d'erreur
 */

// Fonction pour afficher la popup avec les messages
function showAlertPopup($message, $messageType) {
    if (empty($message)) return;
    
    // Déterminer l'icône et la couleur en fonction du type
    $icon = 'info-circle';
    $bgColor = '#0dcaf0'; // Info color
    $textColor = '#fff';
    
    switch ($messageType) {
        case 'success':
            $icon = 'check-circle';
            $bgColor = '#198754'; // Success color
            break;
        case 'warning':
            $icon = 'exclamation-triangle';
            $bgColor = '#ffc107'; // Warning color
            $textColor = '#000';
            break;
        case 'danger':
            $icon = 'times-circle';
            $bgColor = '#dc3545'; // Danger color
            break;
    }
    
    // HTML pour la popup
    ?>
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1080">
        <div id="messageToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="5000">
            <div class="toast-header" style="background-color: <?php echo $bgColor; ?>; color: <?php echo $textColor; ?>;">
                <i class="fas fa-<?php echo $icon; ?> me-2"></i>
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <?php echo $message; ?>
            </div>
        </div>
    </div>
    
    <script>
        // Initialiser le toast Bootstrap
        document.addEventListener('DOMContentLoaded', function() {
            var toastElement = document.getElementById('messageToast');
            var toast = new bootstrap.Toast(toastElement, {
                delay: 5000
            });
            toast.show();
        });
    </script>
    <?php
}
?>
