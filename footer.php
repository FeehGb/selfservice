
<footer>
  <div id="wrap-footer">
    <div class="wrap">
      <section id="block">
        <div id="block-st" class="block">
          <h2>BROWSER RECOMENDADO</h2>
          <div id="browser"><a href="http://www.google.com/intl/pt-BR/chrome/" class="chrome"  target="_blank"></a> <a href="http://www.mozilla.org/pt-BR/firefox/new/" class="firefox" target="_blank"></a> <a href="http://support.apple.com/kb/dl1531" class="safari" target="_blank"></a><a href="http://www.microsoft.com/pt-br/download/internet-explorer-9-details.aspx" class="IE" target="_blank"></a>
          </div>
        </div>
        <div id="block-nd" class="block">
          <h2>ENTRE EM CONTATO</h2>
          <ul id="contact-footer">
            <li><b>FONE</b>
              <div>(84) 9628-6092 <br />
                (84) 8899-9011 </div>
            </li>
            <li><b>ESCREVA-NOS</b>
              <div>moalbuggy@bol.com.br<br />
              </div>
            </li>
            <li><b>SIGA-NOS</b>
              <div> </div>
            </li>
          </ul>
        </div>
        <div id="block-rd" class="block"></div>
      </section>
    </div>
    <!--<div id="google-map">
      <iframe src="http://mapsengine.google.com/map/embed?mid=z_0xDSDe7tTs.kvb-tTpZH118" width="100%" height="250"></iframe>
    </div>--> 
  </div>
  <div id="scrool-wrap"><a href="#scrool-top" class="scroll">subir</a></div>
</footer>
<script>
	$(document).ready(function(e) { 
		$(".scroll").scrolling({before:
			function()
			{
				
				var $obj 		= $("#scrool-wrap");
				var $maxH		= 500;
					
				$(window).scroll(function () {
					if ($(window).scrollTop() > $maxH) {
						
						$obj.css({display:"block"}).stop(false,false).animate({opacity:1},200);
					} else {
						$obj.stop(false,false).animate({opacity:0}, 200,function(){ $(this).css({display:"none"})});
					}
				});
    
			}
		
		})
	});
</script>
</div>
</body></html>