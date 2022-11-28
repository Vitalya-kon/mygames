// ========ФУНКЦИЯ НА JQUERY ДЛЯ ПРИЛИПАНИЯ САЙДБАРА К ВЕРХУ 
jQuery(document).ready(function() {
    jQuery('.content, .sidebar').theiaStickySidebar({
      // Settings
      additionalMarginTop: 30
    });
  });