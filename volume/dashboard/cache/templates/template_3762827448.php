<ktml:style src="theme://css/fonts.css" media="print" onload="this.media='all'; this.onload=null;" />
<ktml:style src="theme://css/output.min.css" rel="preload" as="style" />    

<link rel="preconnect" href="https://cdn.jsdelivr.net/"  />

<ktml:script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer="defer" />

<!--[if IE]>
<ktml:script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine-ie11.min.js"  defer="defer" module="nomodule" />
<![endif]-->

<body class="antialiased bg-gray-100<?php echo isset($this->layout()->pageclass) ? ' ' . $this->layout()->pageclass : '' ?>">
    <ktml:content>
</body>