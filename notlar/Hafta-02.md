ust.php
Bu dosya, sayfanın başlangıç (navbar sidebar vb) kısmını oluşturur.

alt.php
Bu dosya, sayfanın alt kısmını (footer vb) tanımlar.

index.php
Bu dosya, web sayfasının ana içeriğini oluşturur.

```php

<?php
  include "ust.php";
?>

<!--Html içerikleri  ortada bulunur-->


<?php
  include "alt.php";
?>
```

include fonksiyonu ile, her bileşeni ayrı bir dosyada düzenlemek mümkündür. Bu, büyük projelerde kod yönetimini kolaylaştırır.