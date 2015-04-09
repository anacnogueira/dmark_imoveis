<pre class="cake-debug"><a href="javascript:void(0);" onclick="document.getElementById('cakeErr1-trace').style.display = (document.getElementById('cakeErr1-trace').style.display == 'none' ? '' : 'none');"><b>Notice</b> (8)</a>: Undefined variable: erro [<b>APP\controllers\imovels_controller.php</b>, line <b>201</b>]<div id="cakeErr1-trace" class="cake-stack-trace" style="display: none;"><a href="javascript:void(0);" onclick="document.getElementById('cakeErr1-code').style.display = (document.getElementById('cakeErr1-code').style.display == 'none' ? '' : 'none')">Code</a> | <a href="javascript:void(0);" onclick="document.getElementById('cakeErr1-context').style.display = (document.getElementById('cakeErr1-context').style.display == 'none' ? '' : 'none')">Context</a><div id="cakeErr1-code" class="cake-code-dump" style="display: none;"><pre><code><span style="color: #000000">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$erro&nbsp;=&nbsp;'Nenhuma&nbsp;ação&nbsp;definida';
</span></code>
<code><span style="color: #000000">&nbsp;&nbsp;&nbsp;&nbsp;}
</span></code>
<span class="code-highlight"><code><span style="color: #000000">&nbsp;&nbsp;&nbsp;&nbsp;echo&nbsp;$erro;
</span></code></span></pre></div><pre id="cakeErr1-context" class="cake-context" style="display: none;">$acao	=	"upload"
$file	=	File
File::$Folder = Folder object
File::$name = ""
File::$info = array
File::$handle = NULL
File::$lock = NULL
File::$path = "C:\Arquivos de programas\Apache Software Foundation\Apache2.2\htdocs\dmark_novo\app\tmp\"</pre><pre class="stack-trace">ImovelsController::manager_files() - APP\controllers\imovels_controller.php, line 201
Dispatcher::_invoke() - CORE\cake\dispatcher.php, line 204
Dispatcher::dispatch() - CORE\cake\dispatcher.php, line 171
[main] - APP\webroot\index.php, line 83</pre></div></pre>
