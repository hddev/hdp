
  

  


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
        <title>jquery-ui-timepicker-addon.js at master from trentrichardson's jQuery-Timepicker-Addon - GitHub</title>
    <link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="GitHub" />
    <link rel="fluid-icon" href="http://github.com/fluidicon.png" title="GitHub" />

    <link href="http://assets1.github.com/stylesheets/bundle_common.css?accc094c859fe2c8c9c94e58a43e0af05c44b8fd" media="screen" rel="stylesheet" type="text/css" />
<link href="http://assets0.github.com/stylesheets/bundle_github.css?accc094c859fe2c8c9c94e58a43e0af05c44b8fd" media="screen" rel="stylesheet" type="text/css" />

    <script type="text/javascript" charset="utf-8">
      var GitHub = {}
      var github_user = null
      
    </script>
    <script src="http://assets2.github.com/javascripts/jquery/jquery-1.4.2.min.js?accc094c859fe2c8c9c94e58a43e0af05c44b8fd" type="text/javascript"></script>
    <script src="http://assets3.github.com/javascripts/bundle_common.js?accc094c859fe2c8c9c94e58a43e0af05c44b8fd" type="text/javascript"></script>
<script src="http://assets3.github.com/javascripts/bundle_github.js?accc094c859fe2c8c9c94e58a43e0af05c44b8fd" type="text/javascript"></script>

        <script type="text/javascript" charset="utf-8">
      GitHub.spy({
        repo: "trentrichardson/jQuery-Timepicker-Addon"
      })
    </script>

    
  
    
  

  <link href="http://github.com/trentrichardson/jQuery-Timepicker-Addon/commits/master.atom" rel="alternate" title="Recent Commits to jQuery-Timepicker-Addon:master" type="application/atom+xml" />

        <meta name="description" content="Adds a timepicker to jQueryUI Datepicker" />
    <script type="text/javascript">
      GitHub.nameWithOwner = GitHub.nameWithOwner || "trentrichardson/jQuery-Timepicker-Addon";
      GitHub.currentRef = 'master';
    </script>
  

            <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-3769691-2']);
      _gaq.push(['_trackPageview']);
      (function() {
        var ga = document.createElement('script');
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        ga.setAttribute('async', 'true');
        document.documentElement.firstChild.appendChild(ga);
      })();
    </script>

  </head>

  

  <body class="logged_out ">
    

    
      <script type="text/javascript">
        var _kmq = _kmq || [];
        function _kms(u){
          var s = document.createElement('script'); var f = document.getElementsByTagName('script')[0]; s.type = 'text/javascript'; s.async = true;
          s.src = u; f.parentNode.insertBefore(s, f);
        }
        _kms('//i.kissmetrics.com/i.js');_kms('//doug1izaerwt3.cloudfront.net/406e8bf3a2b8846ead55afb3cfaf6664523e3a54.1.js');
      </script>
    

    

    

    

    <div class="subnavd" id="main">
      <div id="header" class="true">
        
          <a class="logo boring" href="http://github.com">
            <img src="/images/modules/header/logov3.png?changed" class="default" alt="github" />
            <![if !IE]>
            <img src="/images/modules/header/logov3-hover.png" class="hover" alt="github" />
            <![endif]>
          </a>
        
        
        <div class="topsearch">
  
    <ul class="nav logged_out">
      <li><a href="http://github.com">Home</a></li>
      <li class="pricing"><a href="/plans">Pricing and Signup</a></li>
      <li><a href="http://github.com/training">Training</a></li>
      <li><a href="http://gist.github.com">Gist</a></li>
      <li><a href="/blog">Blog</a></li>
      <li><a href="https://github.com/login">Login</a></li>
    </ul>
  
</div>

      </div>

      
      
        
    <div class="site">
      <div class="pagehead repohead vis-public   ">
        <h1>
          <a href="/trentrichardson">trentrichardson</a> / <strong><a href="http://github.com/trentrichardson/jQuery-Timepicker-Addon">jQuery-Timepicker-Addon</a></strong>
          
          
        </h1>

        
    <ul class="actions">
      

      
        <li class="for-owner" style="display:none"><a href="https://github.com/trentrichardson/jQuery-Timepicker-Addon/edit" class="minibutton btn-admin "><span><span class="icon"></span>Admin</span></a></li>
        <li>
          <a href="/trentrichardson/jQuery-Timepicker-Addon/toggle_watch" class="minibutton btn-watch " id="watch_button" rel="nofollow" style="display:none"><span><span class="icon"></span>Watch</span></a>
          <a href="/trentrichardson/jQuery-Timepicker-Addon/toggle_watch" class="minibutton btn-watch " id="unwatch_button" rel="nofollow" style="display:none"><span><span class="icon"></span>Unwatch</span></a>
        </li>
        
          
            <li class="for-notforked" style="display:none"><a href="/trentrichardson/jQuery-Timepicker-Addon/fork" class="minibutton btn-fork " id="fork_button" onclick="var f = document.createElement('form'); f.style.display = 'none'; this.parentNode.appendChild(f); f.method = 'POST'; f.action = this.href;var s = document.createElement('input'); s.setAttribute('type', 'hidden'); s.setAttribute('name', 'authenticity_token'); s.setAttribute('value', 'b1eecce999f3ac832295b735c0071a3b4ec4e6b0'); f.appendChild(s);f.submit();return false;"><span><span class="icon"></span>Fork</span></a></li>
            <li class="for-hasfork" style="display:none"><a href="#" class="minibutton btn-fork " id="your_fork_button"><span><span class="icon"></span>Your Fork</span></a></li>
          

          
          <li><a href="#" class="minibutton btn-download " id="download_button"><span><span class="icon"></span>Download Source</span></a></li>
        
      
      
      <li class="repostats">
        <ul class="repo-stats">
          <li class="watchers"><a href="/trentrichardson/jQuery-Timepicker-Addon/watchers" title="Watchers" class="tooltipped downwards">29</a></li>
          <li class="forks"><a href="/trentrichardson/jQuery-Timepicker-Addon/network" title="Forks" class="tooltipped downwards">13</a></li>
        </ul>
      </li>
    </ul>


        
  <ul class="tabs">
    <li><a href="http://github.com/trentrichardson/jQuery-Timepicker-Addon/tree/master" class="selected" highlight="repo_source">Source</a></li>
    <li><a href="http://github.com/trentrichardson/jQuery-Timepicker-Addon/commits/master" highlight="repo_commits">Commits</a></li>

    
    <li><a href="/trentrichardson/jQuery-Timepicker-Addon/network" highlight="repo_network">Network (13)</a></li>

    

    
      
      <li><a href="/trentrichardson/jQuery-Timepicker-Addon/issues" highlight="issues">Issues (0)</a></li>
    

    
      
      <li><a href="/trentrichardson/jQuery-Timepicker-Addon/downloads">Downloads (0)</a></li>
    

                  
    <li><a href="/trentrichardson/jQuery-Timepicker-Addon/graphs" highlight="repo_graphs">Graphs</a></li>

    <li class="contextswitch nochoices">
      <span class="toggle leftwards" >
        <em>Branch:</em>
        <code>master</code>
      </span>
    </li>
  </ul>

  <div style="display:none" id="pl-description"><p><em class="placeholder">click here to add a description</em></p></div>
  <div style="display:none" id="pl-homepage"><p><em class="placeholder">click here to add a homepage</em></p></div>

  <div class="subnav-bar">
  
  <ul>
    <li>
      <a href="#" class="dropdown">Switch Branches (1)</a>
      <ul>
        
          
            <li><strong>master &#x2713;</strong></li>
            
      </ul>
    </li>
    <li>
      <a href="#" class="dropdown defunct">Switch Tags (0)</a>
      
    </li>
    <li>
    
    <a href="/trentrichardson/jQuery-Timepicker-Addon/branches" class="manage">Branch List</a>
    
    </li>
  </ul>
</div>

  
  
  
  
  
  



        
    <div id="repo_details" class="metabox clearfix">
      <div id="repo_details_loader" class="metabox-loader" style="display:none">Sending Request&hellip;</div>

      

      <div id="repository_description" rel="repository_description_edit">
        
          <p>Adds a timepicker to jQueryUI Datepicker
            <span id="read_more" style="display:none">&mdash; <a href="#readme">Read more</a></span>
          </p>
        
      </div>
      <div id="repository_description_edit" style="display:none;" class="inline-edit">
        <form action="/trentrichardson/jQuery-Timepicker-Addon/edit/update" method="post"><div style="margin:0;padding:0"><input name="authenticity_token" type="hidden" value="b1eecce999f3ac832295b735c0071a3b4ec4e6b0" /></div>
          <input type="hidden" name="field" value="repository_description">
          <input type="text" class="textfield" name="value" value="Adds a timepicker to jQueryUI Datepicker">
          <div class="form-actions">
            <button class="minibutton"><span>Save</span></button> &nbsp; <a href="#" class="cancel">Cancel</a>
          </div>
        </form>
      </div>

      
      <div class="repository-homepage" id="repository_homepage" rel="repository_homepage_edit">
        <p><a href="http://trentrichardson.com/examples/timepicker/" rel="nofollow">http://trentrichardson.com/examples/timepicker/</a></p>
      </div>
      <div id="repository_homepage_edit" style="display:none;" class="inline-edit">
        <form action="/trentrichardson/jQuery-Timepicker-Addon/edit/update" method="post"><div style="margin:0;padding:0"><input name="authenticity_token" type="hidden" value="b1eecce999f3ac832295b735c0071a3b4ec4e6b0" /></div>
          <input type="hidden" name="field" value="repository_homepage">
          <input type="text" class="textfield" name="value" value="http://trentrichardson.com/examples/timepicker/">
          <div class="form-actions">
            <button class="minibutton"><span>Save</span></button> &nbsp; <a href="#" class="cancel">Cancel</a>
          </div>
        </form>
      </div>

      <div class="rule "></div>

            <div id="url_box" class="url-box">
        <ul class="clone-urls">
          
            
            <li id="http_clone_url"><a href="http://github.com/trentrichardson/jQuery-Timepicker-Addon.git" data-permissions="Read-Only">HTTP</a></li>
            <li id="public_clone_url"><a href="git://github.com/trentrichardson/jQuery-Timepicker-Addon.git" data-permissions="Read-Only">Git Read-Only</a></li>
          
        </ul>
        <input type="text" spellcheck="false" id="url_field" class="url-field" />
              <span style="display:none" id="url_box_clippy"></span>
      <span id="clippy_tooltip_url_box_clippy" class="clippy-tooltip tooltipped" title="copy to clipboard">
      <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
              width="14"
              height="14"
              class="clippy"
              id="clippy" >
      <param name="movie" value="http://assets2.github.com/flash/clippy.swf?v5"/>
      <param name="allowScriptAccess" value="always" />
      <param name="quality" value="high" />
      <param name="scale" value="noscale" />
      <param NAME="FlashVars" value="id=url_box_clippy&amp;copied=&amp;copyto=">
      <param name="bgcolor" value="#FFFFFF">
      <param name="wmode" value="opaque">
      <embed src="http://assets2.github.com/flash/clippy.swf?v5"
             width="14"
             height="14"
             name="clippy"
             quality="high"
             allowScriptAccess="always"
             type="application/x-shockwave-flash"
             pluginspage="http://www.macromedia.com/go/getflashplayer"
             FlashVars="id=url_box_clippy&amp;copied=&amp;copyto="
             bgcolor="#FFFFFF"
             wmode="opaque"
      />
      </object>
      </span>

        <p id="url_description">This URL has <strong>Read+Write</strong> access</p>
      </div>
    </div>


        

      </div><!-- /.pagehead -->

      









<script type="text/javascript">
  GitHub.currentCommitRef = 'master'
  GitHub.currentRepoOwner = 'trentrichardson'
  GitHub.currentRepo = "jQuery-Timepicker-Addon"
  GitHub.downloadRepo = '/trentrichardson/jQuery-Timepicker-Addon/archives/master'
  GitHub.revType = "master"

  GitHub.controllerName = "blob"
  GitHub.actionName     = "show"
  GitHub.currentAction  = "blob#show"

  

  
</script>










  <div id="commit">
    <div class="group">
        
  <div class="envelope commit">
    <div class="human">
      
        <div class="message"><pre><a href="/trentrichardson/jQuery-Timepicker-Addon/commit/2d641af90d8818139f535439d0b1afad96eeb055">Now displays inline</a> </pre></div>
      

      <div class="actor">
        <div class="gravatar">
          
          <img src="http://www.gravatar.com/avatar/ab4c8036b1eb49d51feac4ab23975c91?s=140&d=http%3A%2F%2Fgithub.com%2Fimages%2Fgravatars%2Fgravatar-140.png" alt="" width="30" height="30"  />
        </div>
        <div class="name"><a href="/trentrichardson">trentrichardson</a> <span>(author)</span></div>
        <div class="date">
          <abbr class="relatize" title="2010-09-22 11:59:29">Wed Sep 22 11:59:29 -0700 2010</abbr>
        </div>
      </div>

      

    </div>
    <div class="machine">
      <span>c</span>ommit&nbsp;&nbsp;<a href="/trentrichardson/jQuery-Timepicker-Addon/commit/2d641af90d8818139f535439d0b1afad96eeb055" hotkey="c">2d641af90d8818139f53</a><br />
      <span>t</span>ree&nbsp;&nbsp;&nbsp;&nbsp;<a href="/trentrichardson/jQuery-Timepicker-Addon/tree/2d641af90d8818139f535439d0b1afad96eeb055" hotkey="t">2c17cff740bcd9fb975b</a><br />
      
        <span>p</span>arent&nbsp;
        
        <a href="/trentrichardson/jQuery-Timepicker-Addon/tree/a06a031f69ba829b3c0caf8ae8c1edbf91172ede" hotkey="p">a06a031f69ba829b3c0c</a>
      

    </div>
  </div>

    </div>
  </div>



  
    <div id="path">
      <b><a href="/trentrichardson/jQuery-Timepicker-Addon/tree/master">jQuery-Timepicker-Addon</a></b> / jquery-ui-timepicker-addon.js       <span style="display:none" id="clippy_2003">jquery-ui-timepicker-addon.js</span>
      
      <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
              width="110"
              height="14"
              class="clippy"
              id="clippy" >
      <param name="movie" value="http://assets3.github.com/flash/clippy.swf?v5"/>
      <param name="allowScriptAccess" value="always" />
      <param name="quality" value="high" />
      <param name="scale" value="noscale" />
      <param NAME="FlashVars" value="id=clippy_2003&amp;copied=copied!&amp;copyto=copy to clipboard">
      <param name="bgcolor" value="#FFFFFF">
      <param name="wmode" value="opaque">
      <embed src="http://assets3.github.com/flash/clippy.swf?v5"
             width="110"
             height="14"
             name="clippy"
             quality="high"
             allowScriptAccess="always"
             type="application/x-shockwave-flash"
             pluginspage="http://www.macromedia.com/go/getflashplayer"
             FlashVars="id=clippy_2003&amp;copied=copied!&amp;copyto=copy to clipboard"
             bgcolor="#FFFFFF"
             wmode="opaque"
      />
      </object>
      

    </div>

    <div id="files">
      <div class="file">
        <div class="meta">
          <div class="info">
            <span class="icon"><img alt="Txt" height="16" src="http://assets0.github.com/images/icons/txt.png?1f716a56cf7dd9f5fb703fcdc59615402030e01a" width="16" /></span>
            <span class="mode" title="File Mode">100755</span>
            
              <span>525 lines (460 sloc)</span>
            
            <span>19.13 kb</span>
          </div>
          <ul class="actions">
            
              <li><a id="file-edit-link" href="#" rel="/trentrichardson/jQuery-Timepicker-Addon/file-edit/__ref__/jquery-ui-timepicker-addon.js">edit</a></li>
            
            <li><a href="/trentrichardson/jQuery-Timepicker-Addon/raw/master/jquery-ui-timepicker-addon.js" id="raw-url">raw</a></li>
            
              <li><a href="/trentrichardson/jQuery-Timepicker-Addon/blame/master/jquery-ui-timepicker-addon.js">blame</a></li>
            
            <li><a href="/trentrichardson/jQuery-Timepicker-Addon/commits/master/jquery-ui-timepicker-addon.js">history</a></li>
          </ul>
        </div>
        
  <div class="data type-javascript">
    
      <table cellpadding="0" cellspacing="0">
        <tr>
          <td>
            <pre class="line_numbers"><span id="LID1" rel="#L1">1</span>
<span id="LID2" rel="#L2">2</span>
<span id="LID3" rel="#L3">3</span>
<span id="LID4" rel="#L4">4</span>
<span id="LID5" rel="#L5">5</span>
<span id="LID6" rel="#L6">6</span>
<span id="LID7" rel="#L7">7</span>
<span id="LID8" rel="#L8">8</span>
<span id="LID9" rel="#L9">9</span>
<span id="LID10" rel="#L10">10</span>
<span id="LID11" rel="#L11">11</span>
<span id="LID12" rel="#L12">12</span>
<span id="LID13" rel="#L13">13</span>
<span id="LID14" rel="#L14">14</span>
<span id="LID15" rel="#L15">15</span>
<span id="LID16" rel="#L16">16</span>
<span id="LID17" rel="#L17">17</span>
<span id="LID18" rel="#L18">18</span>
<span id="LID19" rel="#L19">19</span>
<span id="LID20" rel="#L20">20</span>
<span id="LID21" rel="#L21">21</span>
<span id="LID22" rel="#L22">22</span>
<span id="LID23" rel="#L23">23</span>
<span id="LID24" rel="#L24">24</span>
<span id="LID25" rel="#L25">25</span>
<span id="LID26" rel="#L26">26</span>
<span id="LID27" rel="#L27">27</span>
<span id="LID28" rel="#L28">28</span>
<span id="LID29" rel="#L29">29</span>
<span id="LID30" rel="#L30">30</span>
<span id="LID31" rel="#L31">31</span>
<span id="LID32" rel="#L32">32</span>
<span id="LID33" rel="#L33">33</span>
<span id="LID34" rel="#L34">34</span>
<span id="LID35" rel="#L35">35</span>
<span id="LID36" rel="#L36">36</span>
<span id="LID37" rel="#L37">37</span>
<span id="LID38" rel="#L38">38</span>
<span id="LID39" rel="#L39">39</span>
<span id="LID40" rel="#L40">40</span>
<span id="LID41" rel="#L41">41</span>
<span id="LID42" rel="#L42">42</span>
<span id="LID43" rel="#L43">43</span>
<span id="LID44" rel="#L44">44</span>
<span id="LID45" rel="#L45">45</span>
<span id="LID46" rel="#L46">46</span>
<span id="LID47" rel="#L47">47</span>
<span id="LID48" rel="#L48">48</span>
<span id="LID49" rel="#L49">49</span>
<span id="LID50" rel="#L50">50</span>
<span id="LID51" rel="#L51">51</span>
<span id="LID52" rel="#L52">52</span>
<span id="LID53" rel="#L53">53</span>
<span id="LID54" rel="#L54">54</span>
<span id="LID55" rel="#L55">55</span>
<span id="LID56" rel="#L56">56</span>
<span id="LID57" rel="#L57">57</span>
<span id="LID58" rel="#L58">58</span>
<span id="LID59" rel="#L59">59</span>
<span id="LID60" rel="#L60">60</span>
<span id="LID61" rel="#L61">61</span>
<span id="LID62" rel="#L62">62</span>
<span id="LID63" rel="#L63">63</span>
<span id="LID64" rel="#L64">64</span>
<span id="LID65" rel="#L65">65</span>
<span id="LID66" rel="#L66">66</span>
<span id="LID67" rel="#L67">67</span>
<span id="LID68" rel="#L68">68</span>
<span id="LID69" rel="#L69">69</span>
<span id="LID70" rel="#L70">70</span>
<span id="LID71" rel="#L71">71</span>
<span id="LID72" rel="#L72">72</span>
<span id="LID73" rel="#L73">73</span>
<span id="LID74" rel="#L74">74</span>
<span id="LID75" rel="#L75">75</span>
<span id="LID76" rel="#L76">76</span>
<span id="LID77" rel="#L77">77</span>
<span id="LID78" rel="#L78">78</span>
<span id="LID79" rel="#L79">79</span>
<span id="LID80" rel="#L80">80</span>
<span id="LID81" rel="#L81">81</span>
<span id="LID82" rel="#L82">82</span>
<span id="LID83" rel="#L83">83</span>
<span id="LID84" rel="#L84">84</span>
<span id="LID85" rel="#L85">85</span>
<span id="LID86" rel="#L86">86</span>
<span id="LID87" rel="#L87">87</span>
<span id="LID88" rel="#L88">88</span>
<span id="LID89" rel="#L89">89</span>
<span id="LID90" rel="#L90">90</span>
<span id="LID91" rel="#L91">91</span>
<span id="LID92" rel="#L92">92</span>
<span id="LID93" rel="#L93">93</span>
<span id="LID94" rel="#L94">94</span>
<span id="LID95" rel="#L95">95</span>
<span id="LID96" rel="#L96">96</span>
<span id="LID97" rel="#L97">97</span>
<span id="LID98" rel="#L98">98</span>
<span id="LID99" rel="#L99">99</span>
<span id="LID100" rel="#L100">100</span>
<span id="LID101" rel="#L101">101</span>
<span id="LID102" rel="#L102">102</span>
<span id="LID103" rel="#L103">103</span>
<span id="LID104" rel="#L104">104</span>
<span id="LID105" rel="#L105">105</span>
<span id="LID106" rel="#L106">106</span>
<span id="LID107" rel="#L107">107</span>
<span id="LID108" rel="#L108">108</span>
<span id="LID109" rel="#L109">109</span>
<span id="LID110" rel="#L110">110</span>
<span id="LID111" rel="#L111">111</span>
<span id="LID112" rel="#L112">112</span>
<span id="LID113" rel="#L113">113</span>
<span id="LID114" rel="#L114">114</span>
<span id="LID115" rel="#L115">115</span>
<span id="LID116" rel="#L116">116</span>
<span id="LID117" rel="#L117">117</span>
<span id="LID118" rel="#L118">118</span>
<span id="LID119" rel="#L119">119</span>
<span id="LID120" rel="#L120">120</span>
<span id="LID121" rel="#L121">121</span>
<span id="LID122" rel="#L122">122</span>
<span id="LID123" rel="#L123">123</span>
<span id="LID124" rel="#L124">124</span>
<span id="LID125" rel="#L125">125</span>
<span id="LID126" rel="#L126">126</span>
<span id="LID127" rel="#L127">127</span>
<span id="LID128" rel="#L128">128</span>
<span id="LID129" rel="#L129">129</span>
<span id="LID130" rel="#L130">130</span>
<span id="LID131" rel="#L131">131</span>
<span id="LID132" rel="#L132">132</span>
<span id="LID133" rel="#L133">133</span>
<span id="LID134" rel="#L134">134</span>
<span id="LID135" rel="#L135">135</span>
<span id="LID136" rel="#L136">136</span>
<span id="LID137" rel="#L137">137</span>
<span id="LID138" rel="#L138">138</span>
<span id="LID139" rel="#L139">139</span>
<span id="LID140" rel="#L140">140</span>
<span id="LID141" rel="#L141">141</span>
<span id="LID142" rel="#L142">142</span>
<span id="LID143" rel="#L143">143</span>
<span id="LID144" rel="#L144">144</span>
<span id="LID145" rel="#L145">145</span>
<span id="LID146" rel="#L146">146</span>
<span id="LID147" rel="#L147">147</span>
<span id="LID148" rel="#L148">148</span>
<span id="LID149" rel="#L149">149</span>
<span id="LID150" rel="#L150">150</span>
<span id="LID151" rel="#L151">151</span>
<span id="LID152" rel="#L152">152</span>
<span id="LID153" rel="#L153">153</span>
<span id="LID154" rel="#L154">154</span>
<span id="LID155" rel="#L155">155</span>
<span id="LID156" rel="#L156">156</span>
<span id="LID157" rel="#L157">157</span>
<span id="LID158" rel="#L158">158</span>
<span id="LID159" rel="#L159">159</span>
<span id="LID160" rel="#L160">160</span>
<span id="LID161" rel="#L161">161</span>
<span id="LID162" rel="#L162">162</span>
<span id="LID163" rel="#L163">163</span>
<span id="LID164" rel="#L164">164</span>
<span id="LID165" rel="#L165">165</span>
<span id="LID166" rel="#L166">166</span>
<span id="LID167" rel="#L167">167</span>
<span id="LID168" rel="#L168">168</span>
<span id="LID169" rel="#L169">169</span>
<span id="LID170" rel="#L170">170</span>
<span id="LID171" rel="#L171">171</span>
<span id="LID172" rel="#L172">172</span>
<span id="LID173" rel="#L173">173</span>
<span id="LID174" rel="#L174">174</span>
<span id="LID175" rel="#L175">175</span>
<span id="LID176" rel="#L176">176</span>
<span id="LID177" rel="#L177">177</span>
<span id="LID178" rel="#L178">178</span>
<span id="LID179" rel="#L179">179</span>
<span id="LID180" rel="#L180">180</span>
<span id="LID181" rel="#L181">181</span>
<span id="LID182" rel="#L182">182</span>
<span id="LID183" rel="#L183">183</span>
<span id="LID184" rel="#L184">184</span>
<span id="LID185" rel="#L185">185</span>
<span id="LID186" rel="#L186">186</span>
<span id="LID187" rel="#L187">187</span>
<span id="LID188" rel="#L188">188</span>
<span id="LID189" rel="#L189">189</span>
<span id="LID190" rel="#L190">190</span>
<span id="LID191" rel="#L191">191</span>
<span id="LID192" rel="#L192">192</span>
<span id="LID193" rel="#L193">193</span>
<span id="LID194" rel="#L194">194</span>
<span id="LID195" rel="#L195">195</span>
<span id="LID196" rel="#L196">196</span>
<span id="LID197" rel="#L197">197</span>
<span id="LID198" rel="#L198">198</span>
<span id="LID199" rel="#L199">199</span>
<span id="LID200" rel="#L200">200</span>
<span id="LID201" rel="#L201">201</span>
<span id="LID202" rel="#L202">202</span>
<span id="LID203" rel="#L203">203</span>
<span id="LID204" rel="#L204">204</span>
<span id="LID205" rel="#L205">205</span>
<span id="LID206" rel="#L206">206</span>
<span id="LID207" rel="#L207">207</span>
<span id="LID208" rel="#L208">208</span>
<span id="LID209" rel="#L209">209</span>
<span id="LID210" rel="#L210">210</span>
<span id="LID211" rel="#L211">211</span>
<span id="LID212" rel="#L212">212</span>
<span id="LID213" rel="#L213">213</span>
<span id="LID214" rel="#L214">214</span>
<span id="LID215" rel="#L215">215</span>
<span id="LID216" rel="#L216">216</span>
<span id="LID217" rel="#L217">217</span>
<span id="LID218" rel="#L218">218</span>
<span id="LID219" rel="#L219">219</span>
<span id="LID220" rel="#L220">220</span>
<span id="LID221" rel="#L221">221</span>
<span id="LID222" rel="#L222">222</span>
<span id="LID223" rel="#L223">223</span>
<span id="LID224" rel="#L224">224</span>
<span id="LID225" rel="#L225">225</span>
<span id="LID226" rel="#L226">226</span>
<span id="LID227" rel="#L227">227</span>
<span id="LID228" rel="#L228">228</span>
<span id="LID229" rel="#L229">229</span>
<span id="LID230" rel="#L230">230</span>
<span id="LID231" rel="#L231">231</span>
<span id="LID232" rel="#L232">232</span>
<span id="LID233" rel="#L233">233</span>
<span id="LID234" rel="#L234">234</span>
<span id="LID235" rel="#L235">235</span>
<span id="LID236" rel="#L236">236</span>
<span id="LID237" rel="#L237">237</span>
<span id="LID238" rel="#L238">238</span>
<span id="LID239" rel="#L239">239</span>
<span id="LID240" rel="#L240">240</span>
<span id="LID241" rel="#L241">241</span>
<span id="LID242" rel="#L242">242</span>
<span id="LID243" rel="#L243">243</span>
<span id="LID244" rel="#L244">244</span>
<span id="LID245" rel="#L245">245</span>
<span id="LID246" rel="#L246">246</span>
<span id="LID247" rel="#L247">247</span>
<span id="LID248" rel="#L248">248</span>
<span id="LID249" rel="#L249">249</span>
<span id="LID250" rel="#L250">250</span>
<span id="LID251" rel="#L251">251</span>
<span id="LID252" rel="#L252">252</span>
<span id="LID253" rel="#L253">253</span>
<span id="LID254" rel="#L254">254</span>
<span id="LID255" rel="#L255">255</span>
<span id="LID256" rel="#L256">256</span>
<span id="LID257" rel="#L257">257</span>
<span id="LID258" rel="#L258">258</span>
<span id="LID259" rel="#L259">259</span>
<span id="LID260" rel="#L260">260</span>
<span id="LID261" rel="#L261">261</span>
<span id="LID262" rel="#L262">262</span>
<span id="LID263" rel="#L263">263</span>
<span id="LID264" rel="#L264">264</span>
<span id="LID265" rel="#L265">265</span>
<span id="LID266" rel="#L266">266</span>
<span id="LID267" rel="#L267">267</span>
<span id="LID268" rel="#L268">268</span>
<span id="LID269" rel="#L269">269</span>
<span id="LID270" rel="#L270">270</span>
<span id="LID271" rel="#L271">271</span>
<span id="LID272" rel="#L272">272</span>
<span id="LID273" rel="#L273">273</span>
<span id="LID274" rel="#L274">274</span>
<span id="LID275" rel="#L275">275</span>
<span id="LID276" rel="#L276">276</span>
<span id="LID277" rel="#L277">277</span>
<span id="LID278" rel="#L278">278</span>
<span id="LID279" rel="#L279">279</span>
<span id="LID280" rel="#L280">280</span>
<span id="LID281" rel="#L281">281</span>
<span id="LID282" rel="#L282">282</span>
<span id="LID283" rel="#L283">283</span>
<span id="LID284" rel="#L284">284</span>
<span id="LID285" rel="#L285">285</span>
<span id="LID286" rel="#L286">286</span>
<span id="LID287" rel="#L287">287</span>
<span id="LID288" rel="#L288">288</span>
<span id="LID289" rel="#L289">289</span>
<span id="LID290" rel="#L290">290</span>
<span id="LID291" rel="#L291">291</span>
<span id="LID292" rel="#L292">292</span>
<span id="LID293" rel="#L293">293</span>
<span id="LID294" rel="#L294">294</span>
<span id="LID295" rel="#L295">295</span>
<span id="LID296" rel="#L296">296</span>
<span id="LID297" rel="#L297">297</span>
<span id="LID298" rel="#L298">298</span>
<span id="LID299" rel="#L299">299</span>
<span id="LID300" rel="#L300">300</span>
<span id="LID301" rel="#L301">301</span>
<span id="LID302" rel="#L302">302</span>
<span id="LID303" rel="#L303">303</span>
<span id="LID304" rel="#L304">304</span>
<span id="LID305" rel="#L305">305</span>
<span id="LID306" rel="#L306">306</span>
<span id="LID307" rel="#L307">307</span>
<span id="LID308" rel="#L308">308</span>
<span id="LID309" rel="#L309">309</span>
<span id="LID310" rel="#L310">310</span>
<span id="LID311" rel="#L311">311</span>
<span id="LID312" rel="#L312">312</span>
<span id="LID313" rel="#L313">313</span>
<span id="LID314" rel="#L314">314</span>
<span id="LID315" rel="#L315">315</span>
<span id="LID316" rel="#L316">316</span>
<span id="LID317" rel="#L317">317</span>
<span id="LID318" rel="#L318">318</span>
<span id="LID319" rel="#L319">319</span>
<span id="LID320" rel="#L320">320</span>
<span id="LID321" rel="#L321">321</span>
<span id="LID322" rel="#L322">322</span>
<span id="LID323" rel="#L323">323</span>
<span id="LID324" rel="#L324">324</span>
<span id="LID325" rel="#L325">325</span>
<span id="LID326" rel="#L326">326</span>
<span id="LID327" rel="#L327">327</span>
<span id="LID328" rel="#L328">328</span>
<span id="LID329" rel="#L329">329</span>
<span id="LID330" rel="#L330">330</span>
<span id="LID331" rel="#L331">331</span>
<span id="LID332" rel="#L332">332</span>
<span id="LID333" rel="#L333">333</span>
<span id="LID334" rel="#L334">334</span>
<span id="LID335" rel="#L335">335</span>
<span id="LID336" rel="#L336">336</span>
<span id="LID337" rel="#L337">337</span>
<span id="LID338" rel="#L338">338</span>
<span id="LID339" rel="#L339">339</span>
<span id="LID340" rel="#L340">340</span>
<span id="LID341" rel="#L341">341</span>
<span id="LID342" rel="#L342">342</span>
<span id="LID343" rel="#L343">343</span>
<span id="LID344" rel="#L344">344</span>
<span id="LID345" rel="#L345">345</span>
<span id="LID346" rel="#L346">346</span>
<span id="LID347" rel="#L347">347</span>
<span id="LID348" rel="#L348">348</span>
<span id="LID349" rel="#L349">349</span>
<span id="LID350" rel="#L350">350</span>
<span id="LID351" rel="#L351">351</span>
<span id="LID352" rel="#L352">352</span>
<span id="LID353" rel="#L353">353</span>
<span id="LID354" rel="#L354">354</span>
<span id="LID355" rel="#L355">355</span>
<span id="LID356" rel="#L356">356</span>
<span id="LID357" rel="#L357">357</span>
<span id="LID358" rel="#L358">358</span>
<span id="LID359" rel="#L359">359</span>
<span id="LID360" rel="#L360">360</span>
<span id="LID361" rel="#L361">361</span>
<span id="LID362" rel="#L362">362</span>
<span id="LID363" rel="#L363">363</span>
<span id="LID364" rel="#L364">364</span>
<span id="LID365" rel="#L365">365</span>
<span id="LID366" rel="#L366">366</span>
<span id="LID367" rel="#L367">367</span>
<span id="LID368" rel="#L368">368</span>
<span id="LID369" rel="#L369">369</span>
<span id="LID370" rel="#L370">370</span>
<span id="LID371" rel="#L371">371</span>
<span id="LID372" rel="#L372">372</span>
<span id="LID373" rel="#L373">373</span>
<span id="LID374" rel="#L374">374</span>
<span id="LID375" rel="#L375">375</span>
<span id="LID376" rel="#L376">376</span>
<span id="LID377" rel="#L377">377</span>
<span id="LID378" rel="#L378">378</span>
<span id="LID379" rel="#L379">379</span>
<span id="LID380" rel="#L380">380</span>
<span id="LID381" rel="#L381">381</span>
<span id="LID382" rel="#L382">382</span>
<span id="LID383" rel="#L383">383</span>
<span id="LID384" rel="#L384">384</span>
<span id="LID385" rel="#L385">385</span>
<span id="LID386" rel="#L386">386</span>
<span id="LID387" rel="#L387">387</span>
<span id="LID388" rel="#L388">388</span>
<span id="LID389" rel="#L389">389</span>
<span id="LID390" rel="#L390">390</span>
<span id="LID391" rel="#L391">391</span>
<span id="LID392" rel="#L392">392</span>
<span id="LID393" rel="#L393">393</span>
<span id="LID394" rel="#L394">394</span>
<span id="LID395" rel="#L395">395</span>
<span id="LID396" rel="#L396">396</span>
<span id="LID397" rel="#L397">397</span>
<span id="LID398" rel="#L398">398</span>
<span id="LID399" rel="#L399">399</span>
<span id="LID400" rel="#L400">400</span>
<span id="LID401" rel="#L401">401</span>
<span id="LID402" rel="#L402">402</span>
<span id="LID403" rel="#L403">403</span>
<span id="LID404" rel="#L404">404</span>
<span id="LID405" rel="#L405">405</span>
<span id="LID406" rel="#L406">406</span>
<span id="LID407" rel="#L407">407</span>
<span id="LID408" rel="#L408">408</span>
<span id="LID409" rel="#L409">409</span>
<span id="LID410" rel="#L410">410</span>
<span id="LID411" rel="#L411">411</span>
<span id="LID412" rel="#L412">412</span>
<span id="LID413" rel="#L413">413</span>
<span id="LID414" rel="#L414">414</span>
<span id="LID415" rel="#L415">415</span>
<span id="LID416" rel="#L416">416</span>
<span id="LID417" rel="#L417">417</span>
<span id="LID418" rel="#L418">418</span>
<span id="LID419" rel="#L419">419</span>
<span id="LID420" rel="#L420">420</span>
<span id="LID421" rel="#L421">421</span>
<span id="LID422" rel="#L422">422</span>
<span id="LID423" rel="#L423">423</span>
<span id="LID424" rel="#L424">424</span>
<span id="LID425" rel="#L425">425</span>
<span id="LID426" rel="#L426">426</span>
<span id="LID427" rel="#L427">427</span>
<span id="LID428" rel="#L428">428</span>
<span id="LID429" rel="#L429">429</span>
<span id="LID430" rel="#L430">430</span>
<span id="LID431" rel="#L431">431</span>
<span id="LID432" rel="#L432">432</span>
<span id="LID433" rel="#L433">433</span>
<span id="LID434" rel="#L434">434</span>
<span id="LID435" rel="#L435">435</span>
<span id="LID436" rel="#L436">436</span>
<span id="LID437" rel="#L437">437</span>
<span id="LID438" rel="#L438">438</span>
<span id="LID439" rel="#L439">439</span>
<span id="LID440" rel="#L440">440</span>
<span id="LID441" rel="#L441">441</span>
<span id="LID442" rel="#L442">442</span>
<span id="LID443" rel="#L443">443</span>
<span id="LID444" rel="#L444">444</span>
<span id="LID445" rel="#L445">445</span>
<span id="LID446" rel="#L446">446</span>
<span id="LID447" rel="#L447">447</span>
<span id="LID448" rel="#L448">448</span>
<span id="LID449" rel="#L449">449</span>
<span id="LID450" rel="#L450">450</span>
<span id="LID451" rel="#L451">451</span>
<span id="LID452" rel="#L452">452</span>
<span id="LID453" rel="#L453">453</span>
<span id="LID454" rel="#L454">454</span>
<span id="LID455" rel="#L455">455</span>
<span id="LID456" rel="#L456">456</span>
<span id="LID457" rel="#L457">457</span>
<span id="LID458" rel="#L458">458</span>
<span id="LID459" rel="#L459">459</span>
<span id="LID460" rel="#L460">460</span>
<span id="LID461" rel="#L461">461</span>
<span id="LID462" rel="#L462">462</span>
<span id="LID463" rel="#L463">463</span>
<span id="LID464" rel="#L464">464</span>
<span id="LID465" rel="#L465">465</span>
<span id="LID466" rel="#L466">466</span>
<span id="LID467" rel="#L467">467</span>
<span id="LID468" rel="#L468">468</span>
<span id="LID469" rel="#L469">469</span>
<span id="LID470" rel="#L470">470</span>
<span id="LID471" rel="#L471">471</span>
<span id="LID472" rel="#L472">472</span>
<span id="LID473" rel="#L473">473</span>
<span id="LID474" rel="#L474">474</span>
<span id="LID475" rel="#L475">475</span>
<span id="LID476" rel="#L476">476</span>
<span id="LID477" rel="#L477">477</span>
<span id="LID478" rel="#L478">478</span>
<span id="LID479" rel="#L479">479</span>
<span id="LID480" rel="#L480">480</span>
<span id="LID481" rel="#L481">481</span>
<span id="LID482" rel="#L482">482</span>
<span id="LID483" rel="#L483">483</span>
<span id="LID484" rel="#L484">484</span>
<span id="LID485" rel="#L485">485</span>
<span id="LID486" rel="#L486">486</span>
<span id="LID487" rel="#L487">487</span>
<span id="LID488" rel="#L488">488</span>
<span id="LID489" rel="#L489">489</span>
<span id="LID490" rel="#L490">490</span>
<span id="LID491" rel="#L491">491</span>
<span id="LID492" rel="#L492">492</span>
<span id="LID493" rel="#L493">493</span>
<span id="LID494" rel="#L494">494</span>
<span id="LID495" rel="#L495">495</span>
<span id="LID496" rel="#L496">496</span>
<span id="LID497" rel="#L497">497</span>
<span id="LID498" rel="#L498">498</span>
<span id="LID499" rel="#L499">499</span>
<span id="LID500" rel="#L500">500</span>
<span id="LID501" rel="#L501">501</span>
<span id="LID502" rel="#L502">502</span>
<span id="LID503" rel="#L503">503</span>
<span id="LID504" rel="#L504">504</span>
<span id="LID505" rel="#L505">505</span>
<span id="LID506" rel="#L506">506</span>
<span id="LID507" rel="#L507">507</span>
<span id="LID508" rel="#L508">508</span>
<span id="LID509" rel="#L509">509</span>
<span id="LID510" rel="#L510">510</span>
<span id="LID511" rel="#L511">511</span>
<span id="LID512" rel="#L512">512</span>
<span id="LID513" rel="#L513">513</span>
<span id="LID514" rel="#L514">514</span>
<span id="LID515" rel="#L515">515</span>
<span id="LID516" rel="#L516">516</span>
<span id="LID517" rel="#L517">517</span>
<span id="LID518" rel="#L518">518</span>
<span id="LID519" rel="#L519">519</span>
<span id="LID520" rel="#L520">520</span>
<span id="LID521" rel="#L521">521</span>
<span id="LID522" rel="#L522">522</span>
<span id="LID523" rel="#L523">523</span>
<span id="LID524" rel="#L524">524</span>
<span id="LID525" rel="#L525">525</span>
</pre>
          </td>
          <td width="100%">
            
              <div class="highlight"><pre><div class='line' id='LC1'><span class="cm">/*</span></div><div class='line' id='LC2'><span class="cm">* jQuery timepicker addon</span></div><div class='line' id='LC3'><span class="cm">* By: Trent Richardson [http://trentrichardson.com]</span></div><div class='line' id='LC4'><span class="cm">* Version 0.6.2</span></div><div class='line' id='LC5'><span class="cm">* Last Modified: 9/21/2010</span></div><div class='line' id='LC6'><span class="cm">* </span></div><div class='line' id='LC7'><span class="cm">* Copyright 2010 Trent Richardson</span></div><div class='line' id='LC8'><span class="cm">* Dual licensed under the MIT and GPL licenses.</span></div><div class='line' id='LC9'><span class="cm">* http://trentrichardson.com/Impromptu/GPL-LICENSE.txt</span></div><div class='line' id='LC10'><span class="cm">* http://trentrichardson.com/Impromptu/MIT-LICENSE.txt</span></div><div class='line' id='LC11'><span class="cm">* </span></div><div class='line' id='LC12'><span class="cm">* HERES THE CSS:</span></div><div class='line' id='LC13'><span class="cm">* .ui-timepicker-div dl{ text-align: left; }</span></div><div class='line' id='LC14'><span class="cm">* .ui-timepicker-div dl dt{ height: 25px; }</span></div><div class='line' id='LC15'><span class="cm">* .ui-timepicker-div dl dd{ margin: -25px 0 10px 65px; }</span></div><div class='line' id='LC16'><span class="cm">*/</span></div><div class='line' id='LC17'><br/></div><div class='line' id='LC18'><span class="p">(</span><span class="kd">function</span><span class="p">(</span><span class="nx">$</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC19'>	<span class="kd">function</span> <span class="nx">Timepicker</span><span class="p">(</span><span class="nx">singleton</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC20'>		<span class="k">if</span><span class="p">(</span><span class="k">typeof</span><span class="p">(</span><span class="nx">singleton</span><span class="p">)</span> <span class="o">===</span> <span class="s1">&#39;boolean&#39;</span> <span class="o">&amp;&amp;</span> <span class="nx">singleton</span> <span class="o">==</span> <span class="kc">true</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC21'>			<span class="k">this</span><span class="p">.</span><span class="nx">regional</span> <span class="o">=</span> <span class="p">[];</span> <span class="c1">// Available regional settings, indexed by language code</span></div><div class='line' id='LC22'>			<span class="k">this</span><span class="p">.</span><span class="nx">regional</span><span class="p">[</span><span class="s1">&#39;&#39;</span><span class="p">]</span> <span class="o">=</span> <span class="p">{</span> <span class="c1">// Default regional settings</span></div><div class='line' id='LC23'>				<span class="nx">currentText</span><span class="o">:</span> <span class="s1">&#39;Now&#39;</span><span class="p">,</span></div><div class='line' id='LC24'>				<span class="nx">ampm</span><span class="o">:</span> <span class="kc">false</span><span class="p">,</span></div><div class='line' id='LC25'>				<span class="nx">timeFormat</span><span class="o">:</span> <span class="s1">&#39;hh:mm tt&#39;</span><span class="p">,</span></div><div class='line' id='LC26'>				<span class="nx">timeOnlyTitle</span><span class="o">:</span> <span class="s1">&#39;Choose Time&#39;</span><span class="p">,</span></div><div class='line' id='LC27'>				<span class="nx">timeText</span><span class="o">:</span> <span class="s1">&#39;Time&#39;</span><span class="p">,</span></div><div class='line' id='LC28'>				<span class="nx">hourText</span><span class="o">:</span> <span class="s1">&#39;Hour&#39;</span><span class="p">,</span></div><div class='line' id='LC29'>				<span class="nx">minuteText</span><span class="o">:</span> <span class="s1">&#39;Minute&#39;</span><span class="p">,</span></div><div class='line' id='LC30'>				<span class="nx">secondText</span><span class="o">:</span> <span class="s1">&#39;Second&#39;</span></div><div class='line' id='LC31'>			<span class="p">};</span></div><div class='line' id='LC32'>			<span class="k">this</span><span class="p">.</span><span class="nx">defaults</span> <span class="o">=</span> <span class="p">{</span> <span class="c1">// Global defaults for all the datetime picker instances</span></div><div class='line' id='LC33'>				<span class="nx">showButtonPanel</span><span class="o">:</span> <span class="kc">true</span><span class="p">,</span></div><div class='line' id='LC34'>				<span class="nx">timeOnly</span><span class="o">:</span> <span class="kc">false</span><span class="p">,</span></div><div class='line' id='LC35'>				<span class="nx">showHour</span><span class="o">:</span> <span class="kc">true</span><span class="p">,</span></div><div class='line' id='LC36'>				<span class="nx">showMinute</span><span class="o">:</span> <span class="kc">true</span><span class="p">,</span></div><div class='line' id='LC37'>				<span class="nx">showSecond</span><span class="o">:</span> <span class="kc">false</span><span class="p">,</span></div><div class='line' id='LC38'>				<span class="nx">showTime</span><span class="o">:</span> <span class="kc">true</span><span class="p">,</span></div><div class='line' id='LC39'>				<span class="nx">stepHour</span><span class="o">:</span> <span class="mf">0.05</span><span class="p">,</span></div><div class='line' id='LC40'>				<span class="nx">stepMinute</span><span class="o">:</span> <span class="mf">0.05</span><span class="p">,</span></div><div class='line' id='LC41'>				<span class="nx">stepSecond</span><span class="o">:</span> <span class="mf">0.05</span><span class="p">,</span></div><div class='line' id='LC42'>				<span class="nx">hour</span><span class="o">:</span> <span class="mi">0</span><span class="p">,</span></div><div class='line' id='LC43'>				<span class="nx">minute</span><span class="o">:</span> <span class="mi">0</span><span class="p">,</span></div><div class='line' id='LC44'>				<span class="nx">second</span><span class="o">:</span> <span class="mi">0</span><span class="p">,</span></div><div class='line' id='LC45'>				<span class="nx">hourMin</span><span class="o">:</span> <span class="mi">0</span><span class="p">,</span></div><div class='line' id='LC46'>				<span class="nx">minuteMin</span><span class="o">:</span> <span class="mi">0</span><span class="p">,</span></div><div class='line' id='LC47'>				<span class="nx">secondMin</span><span class="o">:</span> <span class="mi">0</span><span class="p">,</span></div><div class='line' id='LC48'>				<span class="nx">hourMax</span><span class="o">:</span> <span class="mi">23</span><span class="p">,</span></div><div class='line' id='LC49'>				<span class="nx">minuteMax</span><span class="o">:</span> <span class="mi">59</span><span class="p">,</span></div><div class='line' id='LC50'>				<span class="nx">secondMax</span><span class="o">:</span> <span class="mi">59</span><span class="p">,</span></div><div class='line' id='LC51'>				<span class="nx">alwaysSetTime</span><span class="o">:</span> <span class="kc">true</span></div><div class='line' id='LC52'>			<span class="p">};</span></div><div class='line' id='LC53'>			<span class="nx">$</span><span class="p">.</span><span class="nx">extend</span><span class="p">(</span><span class="k">this</span><span class="p">.</span><span class="nx">defaults</span><span class="p">,</span> <span class="k">this</span><span class="p">.</span><span class="nx">regional</span><span class="p">[</span><span class="s1">&#39;&#39;</span><span class="p">]);</span></div><div class='line' id='LC54'>		<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC55'>			<span class="k">this</span><span class="p">.</span><span class="nx">defaults</span> <span class="o">=</span> <span class="nx">$</span><span class="p">.</span><span class="nx">extend</span><span class="p">({},</span> <span class="nx">$</span><span class="p">.</span><span class="nx">timepicker</span><span class="p">.</span><span class="nx">defaults</span><span class="p">);</span></div><div class='line' id='LC56'>		<span class="p">}</span></div><div class='line' id='LC57'><br/></div><div class='line' id='LC58'>	<span class="p">}</span></div><div class='line' id='LC59'><br/></div><div class='line' id='LC60'>	<span class="nx">Timepicker</span><span class="p">.</span><span class="nx">prototype</span> <span class="o">=</span> <span class="p">{</span></div><div class='line' id='LC61'>		<span class="nx">$input</span><span class="o">:</span> <span class="kc">null</span><span class="p">,</span></div><div class='line' id='LC62'>		<span class="nx">$timeObj</span><span class="o">:</span> <span class="kc">null</span><span class="p">,</span></div><div class='line' id='LC63'>		<span class="nx">inst</span><span class="o">:</span> <span class="kc">null</span><span class="p">,</span></div><div class='line' id='LC64'>		<span class="nx">hour_slider</span><span class="o">:</span> <span class="kc">null</span><span class="p">,</span></div><div class='line' id='LC65'>		<span class="nx">minute_slider</span><span class="o">:</span> <span class="kc">null</span><span class="p">,</span></div><div class='line' id='LC66'>		<span class="nx">second_slider</span><span class="o">:</span> <span class="kc">null</span><span class="p">,</span></div><div class='line' id='LC67'>		<span class="nx">hour</span><span class="o">:</span> <span class="mi">0</span><span class="p">,</span></div><div class='line' id='LC68'>		<span class="nx">minute</span><span class="o">:</span> <span class="mi">0</span><span class="p">,</span></div><div class='line' id='LC69'>		<span class="nx">second</span><span class="o">:</span> <span class="mi">0</span><span class="p">,</span></div><div class='line' id='LC70'>		<span class="nx">ampm</span><span class="o">:</span> <span class="s1">&#39;&#39;</span><span class="p">,</span></div><div class='line' id='LC71'>		<span class="nx">formattedDate</span><span class="o">:</span> <span class="s1">&#39;&#39;</span><span class="p">,</span></div><div class='line' id='LC72'>		<span class="nx">formattedTime</span><span class="o">:</span> <span class="s1">&#39;&#39;</span><span class="p">,</span></div><div class='line' id='LC73'>		<span class="nx">formattedDateTime</span><span class="o">:</span> <span class="s1">&#39;&#39;</span><span class="p">,</span></div><div class='line' id='LC74'><br/></div><div class='line' id='LC75'>		<span class="c1">//########################################################################</span></div><div class='line' id='LC76'>		<span class="c1">// add our sliders to the calendar</span></div><div class='line' id='LC77'>		<span class="c1">//########################################################################</span></div><div class='line' id='LC78'>		<span class="nx">addTimePicker</span><span class="o">:</span> <span class="kd">function</span><span class="p">(</span><span class="nx">dp_inst</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC79'>			<span class="kd">var</span> <span class="nx">tp_inst</span> <span class="o">=</span> <span class="k">this</span><span class="p">;</span></div><div class='line' id='LC80'>			<span class="kd">var</span> <span class="nx">currDT</span> <span class="o">=</span> <span class="k">this</span><span class="p">.</span><span class="nx">$input</span><span class="p">.</span><span class="nx">val</span><span class="p">();</span></div><div class='line' id='LC81'>			<span class="kd">var</span> <span class="nx">regstr</span> <span class="o">=</span> <span class="k">this</span><span class="p">.</span><span class="nx">defaults</span><span class="p">.</span><span class="nx">timeFormat</span><span class="p">.</span><span class="nx">toString</span><span class="p">()</span></div><div class='line' id='LC82'>				<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/h{1,2}/ig</span><span class="p">,</span> <span class="s1">&#39;(\\d?\\d)&#39;</span><span class="p">)</span></div><div class='line' id='LC83'>				<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/m{1,2}/ig</span><span class="p">,</span> <span class="s1">&#39;(\\d?\\d)&#39;</span><span class="p">)</span></div><div class='line' id='LC84'>				<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/s{1,2}/ig</span><span class="p">,</span> <span class="s1">&#39;(\\d?\\d)&#39;</span><span class="p">)</span></div><div class='line' id='LC85'>				<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/t{1,2}/ig</span><span class="p">,</span> <span class="s1">&#39;(am|pm|a|p)?&#39;</span><span class="p">)</span></div><div class='line' id='LC86'>				<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/\s/g</span><span class="p">,</span> <span class="s1">&#39;\\s?&#39;</span><span class="p">)</span> <span class="o">+</span> <span class="s1">&#39;$&#39;</span><span class="p">;</span></div><div class='line' id='LC87'><br/></div><div class='line' id='LC88'>			<span class="k">if</span> <span class="p">(</span><span class="o">!</span><span class="k">this</span><span class="p">.</span><span class="nx">defaults</span><span class="p">.</span><span class="nx">timeOnly</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC89'>				<span class="c1">//the time should come after x number of characters and a space.  x = at least the length of text specified by the date format</span></div><div class='line' id='LC90'>				<span class="nx">regstr</span> <span class="o">=</span> <span class="s1">&#39;.{&#39;</span> <span class="o">+</span> <span class="k">this</span><span class="p">.</span><span class="nx">defaults</span><span class="p">.</span><span class="nx">dateFormat</span><span class="p">.</span><span class="nx">length</span> <span class="o">+</span> <span class="s1">&#39;,}\\s+&#39;</span> <span class="o">+</span> <span class="nx">regstr</span><span class="p">;</span></div><div class='line' id='LC91'>			<span class="p">}</span></div><div class='line' id='LC92'><br/></div><div class='line' id='LC93'>			<span class="kd">var</span> <span class="nx">order</span> <span class="o">=</span> <span class="k">this</span><span class="p">.</span><span class="nx">getFormatPositions</span><span class="p">();</span></div><div class='line' id='LC94'>			<span class="kd">var</span> <span class="nx">treg</span> <span class="o">=</span> <span class="nx">currDT</span><span class="p">.</span><span class="nx">match</span><span class="p">(</span><span class="k">new</span> <span class="nb">RegExp</span><span class="p">(</span><span class="nx">regstr</span><span class="p">,</span> <span class="s1">&#39;i&#39;</span><span class="p">));</span></div><div class='line' id='LC95'><br/></div><div class='line' id='LC96'>			<span class="k">if</span> <span class="p">(</span><span class="nx">treg</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC97'>				<span class="k">if</span> <span class="p">(</span><span class="nx">order</span><span class="p">.</span><span class="nx">t</span> <span class="o">!==</span> <span class="o">-</span><span class="mi">1</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC98'>					<span class="k">this</span><span class="p">.</span><span class="nx">ampm</span> <span class="o">=</span> <span class="p">((</span><span class="nx">treg</span><span class="p">[</span><span class="nx">order</span><span class="p">.</span><span class="nx">t</span><span class="p">]</span> <span class="o">===</span> <span class="kc">undefined</span> <span class="o">||</span> <span class="nx">treg</span><span class="p">[</span><span class="nx">order</span><span class="p">.</span><span class="nx">t</span><span class="p">].</span><span class="nx">length</span> <span class="o">===</span> <span class="mi">0</span><span class="p">)</span> <span class="o">?</span> <span class="s1">&#39;&#39;</span> <span class="o">:</span> <span class="p">(</span><span class="nx">treg</span><span class="p">[</span><span class="nx">order</span><span class="p">.</span><span class="nx">t</span><span class="p">].</span><span class="nx">charAt</span><span class="p">(</span><span class="mi">0</span><span class="p">).</span><span class="nx">toUpperCase</span><span class="p">()</span> <span class="o">==</span> <span class="s1">&#39;A&#39;</span><span class="p">)</span> <span class="o">?</span> <span class="s1">&#39;AM&#39;</span> <span class="o">:</span> <span class="s1">&#39;PM&#39;</span><span class="p">).</span><span class="nx">toUpperCase</span><span class="p">();</span></div><div class='line' id='LC99'>				<span class="p">}</span></div><div class='line' id='LC100'><br/></div><div class='line' id='LC101'>				<span class="k">if</span> <span class="p">(</span><span class="nx">order</span><span class="p">.</span><span class="nx">h</span> <span class="o">!==</span> <span class="o">-</span><span class="mi">1</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC102'>					<span class="k">if</span> <span class="p">(</span><span class="k">this</span><span class="p">.</span><span class="nx">ampm</span> <span class="o">==</span> <span class="s1">&#39;AM&#39;</span> <span class="o">&amp;&amp;</span> <span class="nx">treg</span><span class="p">[</span><span class="nx">order</span><span class="p">.</span><span class="nx">h</span><span class="p">]</span> <span class="o">==</span> <span class="s1">&#39;12&#39;</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC103'>						<span class="c1">// 12am = 0 hour</span></div><div class='line' id='LC104'>						<span class="k">this</span><span class="p">.</span><span class="nx">hour</span> <span class="o">=</span> <span class="mi">0</span><span class="p">;</span></div><div class='line' id='LC105'>					<span class="p">}</span> <span class="k">else</span> <span class="k">if</span> <span class="p">(</span><span class="k">this</span><span class="p">.</span><span class="nx">ampm</span> <span class="o">==</span> <span class="s1">&#39;PM&#39;</span> <span class="o">&amp;&amp;</span> <span class="nx">treg</span><span class="p">[</span><span class="nx">order</span><span class="p">.</span><span class="nx">h</span><span class="p">]</span> <span class="o">!=</span> <span class="s1">&#39;12&#39;</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC106'>						<span class="c1">// 12pm = 12 hour, any other pm = hour + 12</span></div><div class='line' id='LC107'>						<span class="k">this</span><span class="p">.</span><span class="nx">hour</span> <span class="o">=</span> <span class="p">(</span><span class="nb">parseFloat</span><span class="p">(</span><span class="nx">treg</span><span class="p">[</span><span class="nx">order</span><span class="p">.</span><span class="nx">h</span><span class="p">])</span> <span class="o">+</span> <span class="mi">12</span><span class="p">).</span><span class="nx">toFixed</span><span class="p">(</span><span class="mi">0</span><span class="p">);</span></div><div class='line' id='LC108'>					<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC109'>						<span class="k">this</span><span class="p">.</span><span class="nx">hour</span> <span class="o">=</span> <span class="nx">treg</span><span class="p">[</span><span class="nx">order</span><span class="p">.</span><span class="nx">h</span><span class="p">];</span></div><div class='line' id='LC110'>					<span class="p">}</span></div><div class='line' id='LC111'>				<span class="p">}</span></div><div class='line' id='LC112'><br/></div><div class='line' id='LC113'>				<span class="k">if</span> <span class="p">(</span><span class="nx">order</span><span class="p">.</span><span class="nx">m</span> <span class="o">!==</span> <span class="o">-</span><span class="mi">1</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC114'>					<span class="k">this</span><span class="p">.</span><span class="nx">minute</span> <span class="o">=</span> <span class="nx">treg</span><span class="p">[</span><span class="nx">order</span><span class="p">.</span><span class="nx">m</span><span class="p">];</span></div><div class='line' id='LC115'>				<span class="p">}</span></div><div class='line' id='LC116'><br/></div><div class='line' id='LC117'>				<span class="k">if</span> <span class="p">(</span><span class="nx">order</span><span class="p">.</span><span class="nx">s</span> <span class="o">!==</span> <span class="o">-</span><span class="mi">1</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC118'>					<span class="k">this</span><span class="p">.</span><span class="nx">second</span> <span class="o">=</span> <span class="nx">treg</span><span class="p">[</span><span class="nx">order</span><span class="p">.</span><span class="nx">s</span><span class="p">];</span></div><div class='line' id='LC119'>				<span class="p">}</span></div><div class='line' id='LC120'>			<span class="p">}</span></div><div class='line' id='LC121'><br/></div><div class='line' id='LC122'>			<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">timeDefined</span> <span class="o">=</span> <span class="p">(</span><span class="nx">treg</span><span class="p">)</span> <span class="o">?</span> <span class="kc">true</span> <span class="o">:</span> <span class="kc">false</span><span class="p">;</span></div><div class='line' id='LC123'><br/></div><div class='line' id='LC124'>			<span class="k">if</span> <span class="p">(</span><span class="k">typeof</span><span class="p">(</span><span class="nx">dp_inst</span><span class="p">.</span><span class="nx">stay_open</span><span class="p">)</span> <span class="o">!==</span> <span class="s1">&#39;boolean&#39;</span> <span class="o">||</span> <span class="nx">dp_inst</span><span class="p">.</span><span class="nx">stay_open</span> <span class="o">===</span> <span class="kc">false</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC125'>			<span class="c1">// wait for datepicker to create itself.. 60% of the time it works every time..</span></div><div class='line' id='LC126'>				<span class="nx">setTimeout</span><span class="p">(</span><span class="kd">function</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC127'>					<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">injectTimePicker</span><span class="p">(</span><span class="nx">dp_inst</span><span class="p">,</span> <span class="nx">tp_inst</span><span class="p">);</span></div><div class='line' id='LC128'>				<span class="p">},</span> <span class="mi">10</span><span class="p">);</span></div><div class='line' id='LC129'>			<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC130'>				<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">injectTimePicker</span><span class="p">(</span><span class="nx">dp_inst</span><span class="p">,</span> <span class="nx">tp_inst</span><span class="p">);</span></div><div class='line' id='LC131'>			<span class="p">}</span></div><div class='line' id='LC132'><br/></div><div class='line' id='LC133'>		<span class="p">},</span></div><div class='line' id='LC134'><br/></div><div class='line' id='LC135'>		<span class="c1">//########################################################################</span></div><div class='line' id='LC136'>		<span class="c1">// figure out position of time elements.. cause js cant do named captures</span></div><div class='line' id='LC137'>		<span class="c1">//########################################################################</span></div><div class='line' id='LC138'>		<span class="nx">getFormatPositions</span><span class="o">:</span> <span class="kd">function</span><span class="p">()</span> <span class="p">{</span></div><div class='line' id='LC139'>			<span class="kd">var</span> <span class="nx">finds</span> <span class="o">=</span> <span class="k">this</span><span class="p">.</span><span class="nx">defaults</span><span class="p">.</span><span class="nx">timeFormat</span><span class="p">.</span><span class="nx">toLowerCase</span><span class="p">().</span><span class="nx">match</span><span class="p">(</span><span class="sr">/(h{1,2}|m{1,2}|s{1,2}|t{1,2})/g</span><span class="p">);</span></div><div class='line' id='LC140'>			<span class="kd">var</span> <span class="nx">orders</span> <span class="o">=</span> <span class="p">{</span> <span class="nx">h</span><span class="o">:</span> <span class="o">-</span><span class="mi">1</span><span class="p">,</span> <span class="nx">m</span><span class="o">:</span> <span class="o">-</span><span class="mi">1</span><span class="p">,</span> <span class="nx">s</span><span class="o">:</span> <span class="o">-</span><span class="mi">1</span><span class="p">,</span> <span class="nx">t</span><span class="o">:</span> <span class="o">-</span><span class="mi">1</span> <span class="p">};</span></div><div class='line' id='LC141'><br/></div><div class='line' id='LC142'>			<span class="k">if</span> <span class="p">(</span><span class="nx">finds</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC143'>				<span class="k">for</span> <span class="p">(</span><span class="kd">var</span> <span class="nx">i</span> <span class="o">=</span> <span class="mi">0</span><span class="p">;</span> <span class="nx">i</span> <span class="o">&lt;</span> <span class="nx">finds</span><span class="p">.</span><span class="nx">length</span><span class="p">;</span> <span class="nx">i</span><span class="o">++</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC144'>					<span class="k">if</span> <span class="p">(</span><span class="nx">orders</span><span class="p">[</span><span class="nx">finds</span><span class="p">[</span><span class="nx">i</span><span class="p">].</span><span class="nx">toString</span><span class="p">().</span><span class="nx">charAt</span><span class="p">(</span><span class="mi">0</span><span class="p">)]</span> <span class="o">==</span> <span class="o">-</span><span class="mi">1</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC145'>						<span class="nx">orders</span><span class="p">[</span><span class="nx">finds</span><span class="p">[</span><span class="nx">i</span><span class="p">].</span><span class="nx">toString</span><span class="p">().</span><span class="nx">charAt</span><span class="p">(</span><span class="mi">0</span><span class="p">)]</span> <span class="o">=</span> <span class="nx">i</span> <span class="o">+</span> <span class="mi">1</span><span class="p">;</span></div><div class='line' id='LC146'>					<span class="p">}</span></div><div class='line' id='LC147'>				<span class="p">}</span></div><div class='line' id='LC148'>			<span class="p">}</span></div><div class='line' id='LC149'><br/></div><div class='line' id='LC150'>			<span class="k">return</span> <span class="nx">orders</span><span class="p">;</span></div><div class='line' id='LC151'>		<span class="p">},</span></div><div class='line' id='LC152'><br/></div><div class='line' id='LC153'>		<span class="c1">//########################################################################</span></div><div class='line' id='LC154'>		<span class="c1">// generate and inject html for timepicker into ui datepicker</span></div><div class='line' id='LC155'>		<span class="c1">//########################################################################</span></div><div class='line' id='LC156'>		<span class="nx">injectTimePicker</span><span class="o">:</span> <span class="kd">function</span><span class="p">(</span><span class="nx">dp_inst</span><span class="p">,</span> <span class="nx">tp_inst</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC157'>			<span class="kd">var</span> <span class="nx">$dp</span> <span class="o">=</span> <span class="nx">dp_inst</span><span class="p">.</span><span class="nx">dpDiv</span><span class="p">;</span></div><div class='line' id='LC158'>			<span class="kd">var</span> <span class="nx">opts</span> <span class="o">=</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">defaults</span><span class="p">;</span></div><div class='line' id='LC159'><br/></div><div class='line' id='LC160'>			<span class="c1">// Added by Peter Medeiros:</span></div><div class='line' id='LC161'>			<span class="c1">// - Figure out what the hour/minute/second max should be based on the step values.</span></div><div class='line' id='LC162'>			<span class="c1">// - Example: if stepMinute is 15, then minMax is 45.</span></div><div class='line' id='LC163'>			<span class="kd">var</span> <span class="nx">hourMax</span> <span class="o">=</span> <span class="nx">opts</span><span class="p">.</span><span class="nx">hourMax</span> <span class="o">-</span> <span class="p">(</span><span class="nx">opts</span><span class="p">.</span><span class="nx">hourMax</span> <span class="o">%</span> <span class="nx">opts</span><span class="p">.</span><span class="nx">stepHour</span><span class="p">);</span></div><div class='line' id='LC164'>			<span class="kd">var</span> <span class="nx">minMax</span>  <span class="o">=</span> <span class="nx">opts</span><span class="p">.</span><span class="nx">minuteMax</span> <span class="o">-</span> <span class="p">(</span><span class="nx">opts</span><span class="p">.</span><span class="nx">minuteMax</span> <span class="o">%</span> <span class="nx">opts</span><span class="p">.</span><span class="nx">stepMinute</span><span class="p">);</span></div><div class='line' id='LC165'>			<span class="kd">var</span> <span class="nx">secMax</span>  <span class="o">=</span> <span class="nx">opts</span><span class="p">.</span><span class="nx">secondMax</span> <span class="o">-</span> <span class="p">(</span><span class="nx">opts</span><span class="p">.</span><span class="nx">secondMax</span> <span class="o">%</span> <span class="nx">opts</span><span class="p">.</span><span class="nx">stepSecond</span><span class="p">);</span></div><div class='line' id='LC166'><br/></div><div class='line' id='LC167'>			<span class="c1">// Prevent displaying twice</span></div><div class='line' id='LC168'>			<span class="k">if</span> <span class="p">(</span><span class="nx">$dp</span><span class="p">.</span><span class="nx">find</span><span class="p">(</span><span class="s2">"div#ui-timepicker-div-"</span><span class="o">+</span> <span class="nx">dp_inst</span><span class="p">.</span><span class="nx">id</span><span class="p">).</span><span class="nx">length</span> <span class="o">===</span> <span class="mi">0</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC169'>				<span class="kd">var</span> <span class="nx">noDisplay</span> <span class="o">=</span> <span class="s1">&#39; style="display:none;"&#39;</span><span class="p">;</span></div><div class='line' id='LC170'>				<span class="kd">var</span> <span class="nx">html</span> <span class="o">=</span></div><div class='line' id='LC171'>					<span class="s1">&#39;&lt;div class="ui-timepicker-div" id="ui-timepicker-div-&#39;</span><span class="o">+</span> <span class="nx">dp_inst</span><span class="p">.</span><span class="nx">id</span> <span class="o">+</span><span class="s1">&#39;"&gt;&lt;dl&gt;&#39;</span> <span class="o">+</span></div><div class='line' id='LC172'>						<span class="s1">&#39;&lt;dt class="ui_tpicker_time_label" id="ui_tpicker_time_label_&#39;</span><span class="o">+</span> <span class="nx">dp_inst</span><span class="p">.</span><span class="nx">id</span> <span class="o">+</span><span class="s1">&#39;"&#39;</span>	<span class="o">+</span> <span class="p">((</span><span class="nx">opts</span><span class="p">.</span><span class="nx">showTime</span><span class="p">)</span>   <span class="o">?</span> <span class="s1">&#39;&#39;</span> <span class="o">:</span> <span class="nx">noDisplay</span><span class="p">)</span> <span class="o">+</span> <span class="s1">&#39;&gt;&#39;</span><span class="o">+</span> <span class="nx">opts</span><span class="p">.</span><span class="nx">timeText</span> <span class="o">+</span><span class="s1">&#39;&lt;/dt&gt;&#39;</span> <span class="o">+</span></div><div class='line' id='LC173'>						<span class="s1">&#39;&lt;dd class="ui_tpicker_time" id="ui_tpicker_time_&#39;</span><span class="o">+</span> <span class="nx">dp_inst</span><span class="p">.</span><span class="nx">id</span> <span class="o">+</span><span class="s1">&#39;"&#39;</span>	<span class="o">+</span> <span class="p">((</span><span class="nx">opts</span><span class="p">.</span><span class="nx">showTime</span><span class="p">)</span>   <span class="o">?</span> <span class="s1">&#39;&#39;</span> <span class="o">:</span> <span class="nx">noDisplay</span><span class="p">)</span> <span class="o">+</span> <span class="s1">&#39;&gt;&lt;/dd&gt;&#39;</span> <span class="o">+</span></div><div class='line' id='LC174'>						<span class="s1">&#39;&lt;dt class="ui_tpicker_hour_label" id="ui_tpicker_hour_label_&#39;</span><span class="o">+</span> <span class="nx">dp_inst</span><span class="p">.</span><span class="nx">id</span> <span class="o">+</span><span class="s1">&#39;"&#39;</span>   <span class="o">+</span> <span class="p">((</span><span class="nx">opts</span><span class="p">.</span><span class="nx">showHour</span><span class="p">)</span>   <span class="o">?</span> <span class="s1">&#39;&#39;</span> <span class="o">:</span> <span class="nx">noDisplay</span><span class="p">)</span> <span class="o">+</span> <span class="s1">&#39;&gt;&#39;</span><span class="o">+</span> <span class="nx">opts</span><span class="p">.</span><span class="nx">hourText</span> <span class="o">+</span><span class="s1">&#39;&lt;/dt&gt;&#39;</span> <span class="o">+</span></div><div class='line' id='LC175'>						<span class="s1">&#39;&lt;dd class="ui_tpicker_hour" id="ui_tpicker_hour_&#39;</span><span class="o">+</span> <span class="nx">dp_inst</span><span class="p">.</span><span class="nx">id</span> <span class="o">+</span><span class="s1">&#39;"&#39;</span>	<span class="o">+</span> <span class="p">((</span><span class="nx">opts</span><span class="p">.</span><span class="nx">showHour</span><span class="p">)</span>   <span class="o">?</span> <span class="s1">&#39;&#39;</span> <span class="o">:</span> <span class="nx">noDisplay</span><span class="p">)</span> <span class="o">+</span> <span class="s1">&#39;&gt;&lt;/dd&gt;&#39;</span> <span class="o">+</span></div><div class='line' id='LC176'>						<span class="s1">&#39;&lt;dt class="ui_tpicker_minute_label" id="ui_tpicker_minute_label_&#39;</span><span class="o">+</span> <span class="nx">dp_inst</span><span class="p">.</span><span class="nx">id</span> <span class="o">+</span><span class="s1">&#39;"&#39;</span>	<span class="o">+</span> <span class="p">((</span><span class="nx">opts</span><span class="p">.</span><span class="nx">showMinute</span><span class="p">)</span> <span class="o">?</span> <span class="s1">&#39;&#39;</span> <span class="o">:</span> <span class="nx">noDisplay</span><span class="p">)</span> <span class="o">+</span> <span class="s1">&#39;&gt;&#39;</span><span class="o">+</span> <span class="nx">opts</span><span class="p">.</span><span class="nx">minuteText</span> <span class="o">+</span><span class="s1">&#39;&lt;/dt&gt;&#39;</span> <span class="o">+</span></div><div class='line' id='LC177'>						<span class="s1">&#39;&lt;dd class="ui_tpicker_minute" id="ui_tpicker_minute_&#39;</span><span class="o">+</span> <span class="nx">dp_inst</span><span class="p">.</span><span class="nx">id</span> <span class="o">+</span><span class="s1">&#39;"&#39;</span>	<span class="o">+</span> <span class="p">((</span><span class="nx">opts</span><span class="p">.</span><span class="nx">showMinute</span><span class="p">)</span> <span class="o">?</span> <span class="s1">&#39;&#39;</span> <span class="o">:</span> <span class="nx">noDisplay</span><span class="p">)</span> <span class="o">+</span> <span class="s1">&#39;&gt;&lt;/dd&gt;&#39;</span> <span class="o">+</span></div><div class='line' id='LC178'>						<span class="s1">&#39;&lt;dt class="ui_tpicker_second_label" id="ui_tpicker_second_label_&#39;</span><span class="o">+</span> <span class="nx">dp_inst</span><span class="p">.</span><span class="nx">id</span> <span class="o">+</span><span class="s1">&#39;"&#39;</span>	<span class="o">+</span> <span class="p">((</span><span class="nx">opts</span><span class="p">.</span><span class="nx">showSecond</span><span class="p">)</span> <span class="o">?</span> <span class="s1">&#39;&#39;</span> <span class="o">:</span> <span class="nx">noDisplay</span><span class="p">)</span> <span class="o">+</span> <span class="s1">&#39;&gt;&#39;</span><span class="o">+</span> <span class="nx">opts</span><span class="p">.</span><span class="nx">secondText</span> <span class="o">+</span><span class="s1">&#39;&lt;/dt&gt;&#39;</span> <span class="o">+</span></div><div class='line' id='LC179'>						<span class="s1">&#39;&lt;dd class="ui_tpicker_second" id="ui_tpicker_second_&#39;</span><span class="o">+</span> <span class="nx">dp_inst</span><span class="p">.</span><span class="nx">id</span> <span class="o">+</span><span class="s1">&#39;"&#39;</span>	<span class="o">+</span> <span class="p">((</span><span class="nx">opts</span><span class="p">.</span><span class="nx">showSecond</span><span class="p">)</span> <span class="o">?</span> <span class="s1">&#39;&#39;</span> <span class="o">:</span> <span class="nx">noDisplay</span><span class="p">)</span> <span class="o">+</span> <span class="s1">&#39;&gt;&lt;/dd&gt;&#39;</span> <span class="o">+</span></div><div class='line' id='LC180'>					<span class="s1">&#39;&lt;/dl&gt;&lt;/div&gt;&#39;</span><span class="p">;</span></div><div class='line' id='LC181'>				<span class="nx">$tp</span> <span class="o">=</span> <span class="nx">$</span><span class="p">(</span><span class="nx">html</span><span class="p">);</span></div><div class='line' id='LC182'><br/></div><div class='line' id='LC183'>				<span class="c1">// if we only want time picker...</span></div><div class='line' id='LC184'>				<span class="k">if</span> <span class="p">(</span><span class="nx">opts</span><span class="p">.</span><span class="nx">timeOnly</span> <span class="o">===</span> <span class="kc">true</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC185'>					<span class="nx">$tp</span><span class="p">.</span><span class="nx">prepend</span><span class="p">(</span></div><div class='line' id='LC186'>						<span class="s1">&#39;&lt;div class="ui-widget-header ui-helper-clearfix ui-corner-all"&gt;&#39;</span> <span class="o">+</span></div><div class='line' id='LC187'>							<span class="s1">&#39;&lt;div class="ui-datepicker-title"&gt;&#39;</span><span class="o">+</span> <span class="nx">opts</span><span class="p">.</span><span class="nx">timeOnlyTitle</span> <span class="o">+</span><span class="s1">&#39;&lt;/div&gt;&#39;</span> <span class="o">+</span></div><div class='line' id='LC188'>						<span class="s1">&#39;&lt;/div&gt;&#39;</span><span class="p">);</span></div><div class='line' id='LC189'>					<span class="nx">$dp</span><span class="p">.</span><span class="nx">find</span><span class="p">(</span><span class="s1">&#39;.ui-datepicker-header, .ui-datepicker-calendar&#39;</span><span class="p">).</span><span class="nx">hide</span><span class="p">();</span></div><div class='line' id='LC190'>				<span class="p">}</span></div><div class='line' id='LC191'><br/></div><div class='line' id='LC192'>				<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">hour_slider</span> <span class="o">=</span> <span class="nx">$tp</span><span class="p">.</span><span class="nx">find</span><span class="p">(</span><span class="s1">&#39;#ui_tpicker_hour_&#39;</span><span class="o">+</span> <span class="nx">dp_inst</span><span class="p">.</span><span class="nx">id</span><span class="p">).</span><span class="nx">slider</span><span class="p">({</span></div><div class='line' id='LC193'>					<span class="nx">orientation</span><span class="o">:</span> <span class="s2">"horizontal"</span><span class="p">,</span></div><div class='line' id='LC194'>					<span class="nx">value</span><span class="o">:</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">hour</span><span class="p">,</span></div><div class='line' id='LC195'>					<span class="nx">min</span><span class="o">:</span> <span class="nx">opts</span><span class="p">.</span><span class="nx">hourMin</span><span class="p">,</span></div><div class='line' id='LC196'>					<span class="nx">max</span><span class="o">:</span> <span class="nx">hourMax</span><span class="p">,</span></div><div class='line' id='LC197'>					<span class="nx">step</span><span class="o">:</span> <span class="nx">opts</span><span class="p">.</span><span class="nx">stepHour</span><span class="p">,</span></div><div class='line' id='LC198'>					<span class="nx">slide</span><span class="o">:</span> <span class="kd">function</span><span class="p">(</span><span class="nx">event</span><span class="p">,</span> <span class="nx">ui</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC199'>						<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">hour_slider</span><span class="p">.</span><span class="nx">slider</span><span class="p">(</span> <span class="s2">"option"</span><span class="p">,</span> <span class="s2">"value"</span><span class="p">,</span> <span class="nx">ui</span><span class="p">.</span><span class="nx">value</span> <span class="p">);</span></div><div class='line' id='LC200'>						<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">onTimeChange</span><span class="p">(</span><span class="nx">dp_inst</span><span class="p">,</span> <span class="nx">tp_inst</span><span class="p">);</span></div><div class='line' id='LC201'>					<span class="p">}</span></div><div class='line' id='LC202'>				<span class="p">});</span></div><div class='line' id='LC203'><br/></div><div class='line' id='LC204'>				<span class="c1">// Updated by Peter Medeiros:</span></div><div class='line' id='LC205'>				<span class="c1">// - Pass in Event and UI instance into slide function</span></div><div class='line' id='LC206'>				<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">minute_slider</span> <span class="o">=</span> <span class="nx">$tp</span><span class="p">.</span><span class="nx">find</span><span class="p">(</span><span class="s1">&#39;#ui_tpicker_minute_&#39;</span><span class="o">+</span> <span class="nx">dp_inst</span><span class="p">.</span><span class="nx">id</span><span class="p">).</span><span class="nx">slider</span><span class="p">({</span></div><div class='line' id='LC207'>					<span class="nx">orientation</span><span class="o">:</span> <span class="s2">"horizontal"</span><span class="p">,</span></div><div class='line' id='LC208'>					<span class="nx">value</span><span class="o">:</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">minute</span><span class="p">,</span></div><div class='line' id='LC209'>					<span class="nx">min</span><span class="o">:</span> <span class="nx">opts</span><span class="p">.</span><span class="nx">minuteMin</span><span class="p">,</span></div><div class='line' id='LC210'>					<span class="nx">max</span><span class="o">:</span> <span class="nx">minMax</span><span class="p">,</span></div><div class='line' id='LC211'>					<span class="nx">step</span><span class="o">:</span> <span class="nx">opts</span><span class="p">.</span><span class="nx">stepMinute</span><span class="p">,</span></div><div class='line' id='LC212'>					<span class="nx">slide</span><span class="o">:</span> <span class="kd">function</span><span class="p">(</span><span class="nx">event</span><span class="p">,</span> <span class="nx">ui</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC213'>						<span class="c1">// update the global minute slider instance value with the current slider value</span></div><div class='line' id='LC214'>						<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">minute_slider</span><span class="p">.</span><span class="nx">slider</span><span class="p">(</span> <span class="s2">"option"</span><span class="p">,</span> <span class="s2">"value"</span><span class="p">,</span> <span class="nx">ui</span><span class="p">.</span><span class="nx">value</span> <span class="p">);</span></div><div class='line' id='LC215'>						<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">onTimeChange</span><span class="p">(</span><span class="nx">dp_inst</span><span class="p">,</span> <span class="nx">tp_inst</span><span class="p">);</span></div><div class='line' id='LC216'>					<span class="p">}</span></div><div class='line' id='LC217'>				<span class="p">});</span></div><div class='line' id='LC218'><br/></div><div class='line' id='LC219'>				<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">second_slider</span> <span class="o">=</span> <span class="nx">$tp</span><span class="p">.</span><span class="nx">find</span><span class="p">(</span><span class="s1">&#39;#ui_tpicker_second_&#39;</span><span class="o">+</span> <span class="nx">dp_inst</span><span class="p">.</span><span class="nx">id</span><span class="p">).</span><span class="nx">slider</span><span class="p">({</span></div><div class='line' id='LC220'>					<span class="nx">orientation</span><span class="o">:</span> <span class="s2">"horizontal"</span><span class="p">,</span></div><div class='line' id='LC221'>					<span class="nx">value</span><span class="o">:</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">second</span><span class="p">,</span></div><div class='line' id='LC222'>					<span class="nx">min</span><span class="o">:</span> <span class="nx">opts</span><span class="p">.</span><span class="nx">secondMin</span><span class="p">,</span></div><div class='line' id='LC223'>					<span class="nx">max</span><span class="o">:</span> <span class="nx">secMax</span><span class="p">,</span></div><div class='line' id='LC224'>					<span class="nx">step</span><span class="o">:</span> <span class="nx">opts</span><span class="p">.</span><span class="nx">stepSecond</span><span class="p">,</span></div><div class='line' id='LC225'>					<span class="nx">slide</span><span class="o">:</span> <span class="kd">function</span><span class="p">(</span><span class="nx">event</span><span class="p">,</span> <span class="nx">ui</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC226'>						<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">second_slider</span><span class="p">.</span><span class="nx">slider</span><span class="p">(</span> <span class="s2">"option"</span><span class="p">,</span> <span class="s2">"value"</span><span class="p">,</span> <span class="nx">ui</span><span class="p">.</span><span class="nx">value</span> <span class="p">);</span></div><div class='line' id='LC227'>						<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">onTimeChange</span><span class="p">(</span><span class="nx">dp_inst</span><span class="p">,</span> <span class="nx">tp_inst</span><span class="p">);</span></div><div class='line' id='LC228'>					<span class="p">}</span></div><div class='line' id='LC229'>				<span class="p">});</span></div><div class='line' id='LC230'><br/></div><div class='line' id='LC231'>				<span class="nx">$dp</span><span class="p">.</span><span class="nx">find</span><span class="p">(</span><span class="s1">&#39;.ui-datepicker-calendar&#39;</span><span class="p">).</span><span class="nx">after</span><span class="p">(</span><span class="nx">$tp</span><span class="p">);</span></div><div class='line' id='LC232'><br/></div><div class='line' id='LC233'>				<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">$timeObj</span> <span class="o">=</span> <span class="nx">$</span><span class="p">(</span><span class="s1">&#39;#ui_tpicker_time_&#39;</span><span class="o">+</span> <span class="nx">dp_inst</span><span class="p">.</span><span class="nx">id</span><span class="p">);</span></div><div class='line' id='LC234'><br/></div><div class='line' id='LC235'>				<span class="k">if</span> <span class="p">(</span><span class="nx">dp_inst</span> <span class="o">!==</span> <span class="kc">null</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC236'>					<span class="kd">var</span> <span class="nx">timeDefined</span> <span class="o">=</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">timeDefined</span><span class="p">;</span></div><div class='line' id='LC237'>					<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">onTimeChange</span><span class="p">(</span><span class="nx">dp_inst</span><span class="p">,</span> <span class="nx">tp_inst</span><span class="p">);</span></div><div class='line' id='LC238'>					<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">timeDefined</span> <span class="o">=</span> <span class="nx">timeDefined</span><span class="p">;</span></div><div class='line' id='LC239'>				<span class="p">}</span></div><div class='line' id='LC240'>			<span class="p">}</span></div><div class='line' id='LC241'>		<span class="p">},</span></div><div class='line' id='LC242'><br/></div><div class='line' id='LC243'>		<span class="c1">//########################################################################</span></div><div class='line' id='LC244'>		<span class="c1">// when a slider moves..</span></div><div class='line' id='LC245'>		<span class="c1">// on time change is also called when the time is updated in the text field</span></div><div class='line' id='LC246'>		<span class="c1">//########################################################################</span></div><div class='line' id='LC247'>		<span class="nx">onTimeChange</span><span class="o">:</span> <span class="kd">function</span><span class="p">(</span><span class="nx">dp_inst</span><span class="p">,</span> <span class="nx">tp_inst</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC248'>			<span class="kd">var</span> <span class="nx">hour</span>   <span class="o">=</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">hour_slider</span><span class="p">.</span><span class="nx">slider</span><span class="p">(</span><span class="s1">&#39;value&#39;</span><span class="p">);</span></div><div class='line' id='LC249'>			<span class="kd">var</span> <span class="nx">minute</span> <span class="o">=</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">minute_slider</span><span class="p">.</span><span class="nx">slider</span><span class="p">(</span><span class="s1">&#39;value&#39;</span><span class="p">);</span></div><div class='line' id='LC250'>			<span class="kd">var</span> <span class="nx">second</span> <span class="o">=</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">second_slider</span><span class="p">.</span><span class="nx">slider</span><span class="p">(</span><span class="s1">&#39;value&#39;</span><span class="p">);</span></div><div class='line' id='LC251'>			<span class="kd">var</span> <span class="nx">ampm</span> <span class="o">=</span> <span class="p">(</span><span class="nx">hour</span> <span class="o">&lt;</span> <span class="mi">12</span><span class="p">)</span> <span class="o">?</span> <span class="s1">&#39;AM&#39;</span> <span class="o">:</span> <span class="s1">&#39;PM&#39;</span><span class="p">;</span></div><div class='line' id='LC252'>			<span class="kd">var</span> <span class="nx">hasChanged</span> <span class="o">=</span> <span class="kc">false</span><span class="p">;</span></div><div class='line' id='LC253'><br/></div><div class='line' id='LC254'>			<span class="c1">// If the update was done in the input field, this field should not be updated.</span></div><div class='line' id='LC255'>			<span class="c1">// If the update was done using the sliders, update the input field.</span></div><div class='line' id='LC256'>			<span class="k">if</span> <span class="p">(</span><span class="nx">tp_inst</span><span class="p">.</span><span class="nx">hour</span> <span class="o">!=</span> <span class="nx">hour</span> <span class="o">||</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">minute</span> <span class="o">!=</span> <span class="nx">minute</span> <span class="o">||</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">second</span> <span class="o">!=</span> <span class="nx">second</span> <span class="o">||</span> <span class="p">(</span><span class="nx">tp_inst</span><span class="p">.</span><span class="nx">ampm</span><span class="p">.</span><span class="nx">length</span> <span class="o">&gt;</span> <span class="mi">0</span> <span class="o">&amp;&amp;</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">ampm</span> <span class="o">!=</span> <span class="nx">ampm</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC257'>				<span class="nx">hasChanged</span> <span class="o">=</span> <span class="kc">true</span><span class="p">;</span></div><div class='line' id='LC258'>			<span class="p">}</span></div><div class='line' id='LC259'><br/></div><div class='line' id='LC260'>			<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">hour</span> <span class="o">=</span> <span class="nb">parseFloat</span><span class="p">(</span><span class="nx">hour</span><span class="p">).</span><span class="nx">toFixed</span><span class="p">(</span><span class="mi">0</span><span class="p">);</span></div><div class='line' id='LC261'>			<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">minute</span> <span class="o">=</span> <span class="nb">parseFloat</span><span class="p">(</span><span class="nx">minute</span><span class="p">).</span><span class="nx">toFixed</span><span class="p">(</span><span class="mi">0</span><span class="p">);</span></div><div class='line' id='LC262'>			<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">second</span> <span class="o">=</span> <span class="nb">parseFloat</span><span class="p">(</span><span class="nx">second</span><span class="p">).</span><span class="nx">toFixed</span><span class="p">(</span><span class="mi">0</span><span class="p">);</span></div><div class='line' id='LC263'>			<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">ampm</span> <span class="o">=</span> <span class="nx">ampm</span><span class="p">;</span></div><div class='line' id='LC264'><br/></div><div class='line' id='LC265'>			<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">formatTime</span><span class="p">(</span><span class="nx">tp_inst</span><span class="p">);</span></div><div class='line' id='LC266'>			<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">$timeObj</span><span class="p">.</span><span class="nx">text</span><span class="p">(</span><span class="nx">tp_inst</span><span class="p">.</span><span class="nx">formattedTime</span><span class="p">);</span></div><div class='line' id='LC267'><br/></div><div class='line' id='LC268'>			<span class="k">if</span> <span class="p">(</span><span class="nx">hasChanged</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC269'>				<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">updateDateTime</span><span class="p">(</span><span class="nx">dp_inst</span><span class="p">,</span> <span class="nx">tp_inst</span><span class="p">);</span></div><div class='line' id='LC270'>				<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">timeDefined</span> <span class="o">=</span> <span class="kc">true</span><span class="p">;</span></div><div class='line' id='LC271'>			<span class="p">}</span></div><div class='line' id='LC272'>		<span class="p">},</span></div><div class='line' id='LC273'><br/></div><div class='line' id='LC274'>		<span class="c1">//########################################################################</span></div><div class='line' id='LC275'>		<span class="c1">// format the time all pretty...</span></div><div class='line' id='LC276'>		<span class="c1">//########################################################################</span></div><div class='line' id='LC277'>		<span class="nx">formatTime</span><span class="o">:</span> <span class="kd">function</span><span class="p">(</span><span class="nx">tp_inst</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC278'>			<span class="kd">var</span> <span class="nx">tmptime</span> <span class="o">=</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">defaults</span><span class="p">.</span><span class="nx">timeFormat</span><span class="p">.</span><span class="nx">toString</span><span class="p">();</span></div><div class='line' id='LC279'>			<span class="kd">var</span> <span class="nx">hour12</span> <span class="o">=</span> <span class="p">((</span><span class="nx">tp_inst</span><span class="p">.</span><span class="nx">ampm</span> <span class="o">==</span> <span class="s1">&#39;AM&#39;</span><span class="p">)</span> <span class="o">?</span> <span class="p">(</span><span class="nx">tp_inst</span><span class="p">.</span><span class="nx">hour</span><span class="p">)</span> <span class="o">:</span> <span class="p">(</span><span class="nx">tp_inst</span><span class="p">.</span><span class="nx">hour</span> <span class="o">%</span> <span class="mi">12</span><span class="p">));</span></div><div class='line' id='LC280'>			<span class="nx">hour12</span> <span class="o">=</span> <span class="p">(</span><span class="nx">hour12</span> <span class="o">===</span> <span class="mi">0</span><span class="p">)</span> <span class="o">?</span> <span class="mi">12</span> <span class="o">:</span> <span class="nx">hour12</span><span class="p">;</span></div><div class='line' id='LC281'><br/></div><div class='line' id='LC282'>			<span class="k">if</span> <span class="p">(</span><span class="nx">tp_inst</span><span class="p">.</span><span class="nx">defaults</span><span class="p">.</span><span class="nx">ampm</span> <span class="o">===</span> <span class="kc">true</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC283'>				<span class="nx">tmptime</span> <span class="o">=</span> <span class="nx">tmptime</span><span class="p">.</span><span class="nx">toString</span><span class="p">()</span></div><div class='line' id='LC284'>					<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/hh/g</span><span class="p">,</span> <span class="p">((</span><span class="nx">hour12</span> <span class="o">&lt;</span> <span class="mi">10</span><span class="p">)</span> <span class="o">?</span> <span class="s1">&#39;0&#39;</span> <span class="o">:</span> <span class="s1">&#39;&#39;</span><span class="p">)</span> <span class="o">+</span> <span class="nx">hour12</span><span class="p">)</span></div><div class='line' id='LC285'>					<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/h/g</span><span class="p">,</span> <span class="nx">hour12</span><span class="p">)</span></div><div class='line' id='LC286'>					<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/mm/g</span><span class="p">,</span> <span class="p">((</span><span class="nx">tp_inst</span><span class="p">.</span><span class="nx">minute</span> <span class="o">&lt;</span> <span class="mi">10</span><span class="p">)</span> <span class="o">?</span> <span class="s1">&#39;0&#39;</span> <span class="o">:</span> <span class="s1">&#39;&#39;</span><span class="p">)</span> <span class="o">+</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">minute</span><span class="p">)</span></div><div class='line' id='LC287'>					<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/m/g</span><span class="p">,</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">minute</span><span class="p">)</span></div><div class='line' id='LC288'>					<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/ss/g</span><span class="p">,</span> <span class="p">((</span><span class="nx">tp_inst</span><span class="p">.</span><span class="nx">second</span> <span class="o">&lt;</span> <span class="mi">10</span><span class="p">)</span> <span class="o">?</span> <span class="s1">&#39;0&#39;</span> <span class="o">:</span> <span class="s1">&#39;&#39;</span><span class="p">)</span> <span class="o">+</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">second</span><span class="p">)</span></div><div class='line' id='LC289'>					<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/s/g</span><span class="p">,</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">second</span><span class="p">)</span></div><div class='line' id='LC290'>					<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/TT/g</span><span class="p">,</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">ampm</span><span class="p">.</span><span class="nx">toUpperCase</span><span class="p">())</span></div><div class='line' id='LC291'>					<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/tt/g</span><span class="p">,</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">ampm</span><span class="p">.</span><span class="nx">toLowerCase</span><span class="p">())</span></div><div class='line' id='LC292'>					<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/T/g</span><span class="p">,</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">ampm</span><span class="p">.</span><span class="nx">charAt</span><span class="p">(</span><span class="mi">0</span><span class="p">).</span><span class="nx">toUpperCase</span><span class="p">())</span></div><div class='line' id='LC293'>					<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/t/g</span><span class="p">,</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">ampm</span><span class="p">.</span><span class="nx">charAt</span><span class="p">(</span><span class="mi">0</span><span class="p">).</span><span class="nx">toLowerCase</span><span class="p">());</span></div><div class='line' id='LC294'><br/></div><div class='line' id='LC295'>			<span class="p">}</span> <span class="k">else</span> <span class="p">{</span></div><div class='line' id='LC296'>				<span class="nx">tmptime</span> <span class="o">=</span> <span class="nx">tmptime</span><span class="p">.</span><span class="nx">toString</span><span class="p">()</span></div><div class='line' id='LC297'>					<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/hh/g</span><span class="p">,</span> <span class="p">((</span><span class="nx">tp_inst</span><span class="p">.</span><span class="nx">hour</span> <span class="o">&lt;</span> <span class="mi">10</span><span class="p">)</span> <span class="o">?</span> <span class="s1">&#39;0&#39;</span> <span class="o">:</span> <span class="s1">&#39;&#39;</span><span class="p">)</span> <span class="o">+</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">hour</span><span class="p">)</span></div><div class='line' id='LC298'>					<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/h/g</span><span class="p">,</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">hour</span><span class="p">)</span></div><div class='line' id='LC299'>					<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/mm/g</span><span class="p">,</span> <span class="p">((</span><span class="nx">tp_inst</span><span class="p">.</span><span class="nx">minute</span> <span class="o">&lt;</span> <span class="mi">10</span><span class="p">)</span> <span class="o">?</span> <span class="s1">&#39;0&#39;</span> <span class="o">:</span> <span class="s1">&#39;&#39;</span><span class="p">)</span> <span class="o">+</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">minute</span><span class="p">)</span></div><div class='line' id='LC300'>					<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/m/g</span><span class="p">,</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">minute</span><span class="p">)</span></div><div class='line' id='LC301'>					<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/ss/g</span><span class="p">,</span> <span class="p">((</span><span class="nx">tp_inst</span><span class="p">.</span><span class="nx">second</span> <span class="o">&lt;</span> <span class="mi">10</span><span class="p">)</span> <span class="o">?</span> <span class="s1">&#39;0&#39;</span> <span class="o">:</span> <span class="s1">&#39;&#39;</span><span class="p">)</span> <span class="o">+</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">second</span><span class="p">)</span></div><div class='line' id='LC302'>					<span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/s/g</span><span class="p">,</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">second</span><span class="p">);</span></div><div class='line' id='LC303'>				<span class="nx">tmptime</span> <span class="o">=</span> <span class="nx">$</span><span class="p">.</span><span class="nx">trim</span><span class="p">(</span><span class="nx">tmptime</span><span class="p">.</span><span class="nx">replace</span><span class="p">(</span><span class="sr">/t/gi</span><span class="p">,</span> <span class="s1">&#39;&#39;</span><span class="p">));</span></div><div class='line' id='LC304'>			<span class="p">}</span></div><div class='line' id='LC305'><br/></div><div class='line' id='LC306'>			<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">formattedTime</span> <span class="o">=</span> <span class="nx">tmptime</span><span class="p">;</span></div><div class='line' id='LC307'>			<span class="k">return</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">formattedTime</span><span class="p">;</span></div><div class='line' id='LC308'>		<span class="p">},</span></div><div class='line' id='LC309'><br/></div><div class='line' id='LC310'>		<span class="c1">//########################################################################</span></div><div class='line' id='LC311'>		<span class="c1">// update our input with the new date time..</span></div><div class='line' id='LC312'>		<span class="c1">//########################################################################</span></div><div class='line' id='LC313'>		<span class="nx">updateDateTime</span><span class="o">:</span> <span class="kd">function</span><span class="p">(</span><span class="nx">dp_inst</span><span class="p">,</span> <span class="nx">tp_inst</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC314'>			<span class="c1">//var dt = this.$input.datepicker(&#39;getDate&#39;);</span></div><div class='line' id='LC315'>			<span class="kd">var</span> <span class="nx">dt</span> <span class="o">=</span> <span class="k">new</span> <span class="nb">Date</span><span class="p">(</span><span class="nx">dp_inst</span><span class="p">.</span><span class="nx">selectedYear</span><span class="p">,</span> <span class="nx">dp_inst</span><span class="p">.</span><span class="nx">selectedMonth</span><span class="p">,</span> <span class="nx">dp_inst</span><span class="p">.</span><span class="nx">selectedDay</span><span class="p">);</span></div><div class='line' id='LC316'>			<span class="kd">var</span> <span class="nx">dateFmt</span> <span class="o">=</span> <span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_get</span><span class="p">(</span><span class="nx">dp_inst</span><span class="p">,</span> <span class="s1">&#39;dateFormat&#39;</span><span class="p">);</span></div><div class='line' id='LC317'>			<span class="kd">var</span> <span class="nx">formatCfg</span> <span class="o">=</span> <span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_getFormatConfig</span><span class="p">(</span><span class="nx">dp_inst</span><span class="p">);</span></div><div class='line' id='LC318'>			<span class="k">this</span><span class="p">.</span><span class="nx">formattedDate</span> <span class="o">=</span> <span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">formatDate</span><span class="p">(</span><span class="nx">dateFmt</span><span class="p">,</span> <span class="p">(</span><span class="nx">dt</span> <span class="o">===</span> <span class="kc">null</span> <span class="o">?</span> <span class="k">new</span> <span class="nb">Date</span><span class="p">()</span> <span class="o">:</span> <span class="nx">dt</span><span class="p">),</span> <span class="nx">formatCfg</span><span class="p">);</span></div><div class='line' id='LC319'>			<span class="kd">var</span> <span class="nx">formattedDateTime</span> <span class="o">=</span> <span class="k">this</span><span class="p">.</span><span class="nx">formattedDate</span><span class="p">;</span></div><div class='line' id='LC320'>			<span class="kd">var</span> <span class="nx">timeAvailable</span> <span class="o">=</span> <span class="nx">dt</span> <span class="o">!==</span> <span class="kc">null</span> <span class="o">&amp;&amp;</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">timeDefined</span><span class="p">;</span></div><div class='line' id='LC321'><br/></div><div class='line' id='LC322'>			<span class="k">if</span><span class="p">(</span><span class="k">this</span><span class="p">.</span><span class="nx">defaults</span><span class="p">.</span><span class="nx">timeOnly</span> <span class="o">===</span> <span class="kc">true</span><span class="p">){</span></div><div class='line' id='LC323'>				<span class="nx">formattedDateTime</span> <span class="o">=</span> <span class="k">this</span><span class="p">.</span><span class="nx">formattedTime</span><span class="p">;</span></div><div class='line' id='LC324'>			<span class="p">}</span></div><div class='line' id='LC325'>			<span class="k">else</span> <span class="k">if</span> <span class="p">(</span><span class="k">this</span><span class="p">.</span><span class="nx">defaults</span><span class="p">.</span><span class="nx">timeOnly</span> <span class="o">!==</span> <span class="kc">true</span> <span class="o">&amp;&amp;</span> <span class="p">(</span><span class="k">this</span><span class="p">.</span><span class="nx">defaults</span><span class="p">.</span><span class="nx">alwaysSetTime</span> <span class="o">||</span> <span class="nx">timeAvailable</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC326'>				<span class="nx">formattedDateTime</span> <span class="o">+=</span> <span class="s1">&#39; &#39;</span> <span class="o">+</span> <span class="k">this</span><span class="p">.</span><span class="nx">formattedTime</span><span class="p">;</span></div><div class='line' id='LC327'>			<span class="p">}</span></div><div class='line' id='LC328'><br/></div><div class='line' id='LC329'>			<span class="k">this</span><span class="p">.</span><span class="nx">formattedDateTime</span> <span class="o">=</span> <span class="nx">formattedDateTime</span><span class="p">;</span></div><div class='line' id='LC330'>			<span class="k">this</span><span class="p">.</span><span class="nx">$input</span><span class="p">.</span><span class="nx">val</span><span class="p">(</span><span class="nx">formattedDateTime</span><span class="p">);</span></div><div class='line' id='LC331'>		<span class="p">},</span></div><div class='line' id='LC332'><br/></div><div class='line' id='LC333'>		<span class="nx">setDefaults</span><span class="o">:</span> <span class="kd">function</span><span class="p">(</span><span class="nx">settings</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC334'>			<span class="nx">extendRemove</span><span class="p">(</span><span class="k">this</span><span class="p">.</span><span class="nx">defaults</span><span class="p">,</span> <span class="nx">settings</span> <span class="o">||</span> <span class="p">{});</span></div><div class='line' id='LC335'>			<span class="k">return</span> <span class="k">this</span><span class="p">;</span></div><div class='line' id='LC336'>		<span class="p">}</span></div><div class='line' id='LC337'>	<span class="p">};</span></div><div class='line' id='LC338'><br/></div><div class='line' id='LC339'>	<span class="c1">//########################################################################</span></div><div class='line' id='LC340'>	<span class="c1">// extend timepicker to datepicker</span></div><div class='line' id='LC341'>	<span class="c1">//########################################################################		</span></div><div class='line' id='LC342'>	<span class="nx">jQuery</span><span class="p">.</span><span class="nx">fn</span><span class="p">.</span><span class="nx">datetimepicker</span> <span class="o">=</span> <span class="kd">function</span><span class="p">(</span><span class="nx">o</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC343'>		<span class="kd">var</span> <span class="nx">opts</span> <span class="o">=</span> <span class="p">(</span><span class="nx">o</span> <span class="o">===</span> <span class="kc">undefined</span> <span class="o">?</span> <span class="p">{}</span> <span class="o">:</span> <span class="nx">o</span><span class="p">);</span></div><div class='line' id='LC344'>		<span class="kd">var</span> <span class="nx">input</span> <span class="o">=</span> <span class="nx">$</span><span class="p">(</span><span class="k">this</span><span class="p">);</span></div><div class='line' id='LC345'>		<span class="kd">var</span> <span class="nx">tp</span> <span class="o">=</span> <span class="k">new</span> <span class="nx">Timepicker</span><span class="p">();</span></div><div class='line' id='LC346'>		<span class="kd">var</span> <span class="nx">inlineSettings</span> <span class="o">=</span> <span class="p">{};</span></div><div class='line' id='LC347'><br/></div><div class='line' id='LC348'>		<span class="k">for</span> <span class="p">(</span><span class="kd">var</span> <span class="nx">attrName</span> <span class="k">in</span> <span class="nx">tp</span><span class="p">.</span><span class="nx">defaults</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC349'>			<span class="kd">var</span> <span class="nx">attrValue</span> <span class="o">=</span> <span class="nx">input</span><span class="p">.</span><span class="nx">attr</span><span class="p">(</span><span class="s1">&#39;time:&#39;</span> <span class="o">+</span> <span class="nx">attrName</span><span class="p">);</span></div><div class='line' id='LC350'>			<span class="k">if</span> <span class="p">(</span><span class="nx">attrValue</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC351'>				<span class="k">try</span> <span class="p">{</span></div><div class='line' id='LC352'>					<span class="nx">inlineSettings</span><span class="p">[</span><span class="nx">attrName</span><span class="p">]</span> <span class="o">=</span> <span class="nb">eval</span><span class="p">(</span><span class="nx">attrValue</span><span class="p">);</span></div><div class='line' id='LC353'>				<span class="p">}</span> <span class="k">catch</span> <span class="p">(</span><span class="nx">err</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC354'>					<span class="nx">inlineSettings</span><span class="p">[</span><span class="nx">attrName</span><span class="p">]</span> <span class="o">=</span> <span class="nx">attrValue</span><span class="p">;</span></div><div class='line' id='LC355'>				<span class="p">}</span></div><div class='line' id='LC356'>			<span class="p">}</span></div><div class='line' id='LC357'>		<span class="p">}</span></div><div class='line' id='LC358'>		<span class="nx">tp</span><span class="p">.</span><span class="nx">defaults</span> <span class="o">=</span> <span class="nx">$</span><span class="p">.</span><span class="nx">extend</span><span class="p">(</span><span class="nx">tp</span><span class="p">.</span><span class="nx">defaults</span><span class="p">,</span> <span class="nx">inlineSettings</span><span class="p">);</span></div><div class='line' id='LC359'><br/></div><div class='line' id='LC360'>		<span class="kd">var</span> <span class="nx">beforeShowFunc</span> <span class="o">=</span> <span class="kd">function</span><span class="p">(</span><span class="nx">input</span><span class="p">,</span> <span class="nx">inst</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC361'>			<span class="nx">tp</span><span class="p">.</span><span class="nx">hour</span> <span class="o">=</span> <span class="nx">tp</span><span class="p">.</span><span class="nx">defaults</span><span class="p">.</span><span class="nx">hour</span><span class="p">;</span></div><div class='line' id='LC362'>			<span class="nx">tp</span><span class="p">.</span><span class="nx">minute</span> <span class="o">=</span> <span class="nx">tp</span><span class="p">.</span><span class="nx">defaults</span><span class="p">.</span><span class="nx">minute</span><span class="p">;</span></div><div class='line' id='LC363'>			<span class="nx">tp</span><span class="p">.</span><span class="nx">second</span> <span class="o">=</span> <span class="nx">tp</span><span class="p">.</span><span class="nx">defaults</span><span class="p">.</span><span class="nx">second</span><span class="p">;</span></div><div class='line' id='LC364'>			<span class="nx">tp</span><span class="p">.</span><span class="nx">ampm</span> <span class="o">=</span> <span class="s1">&#39;&#39;</span><span class="p">;</span></div><div class='line' id='LC365'>			<span class="nx">tp</span><span class="p">.</span><span class="nx">$input</span> <span class="o">=</span> <span class="nx">$</span><span class="p">(</span><span class="nx">input</span><span class="p">);</span></div><div class='line' id='LC366'>			<span class="nx">tp</span><span class="p">.</span><span class="nx">inst</span> <span class="o">=</span> <span class="nx">inst</span><span class="p">;</span></div><div class='line' id='LC367'>			<span class="nx">tp</span><span class="p">.</span><span class="nx">addTimePicker</span><span class="p">(</span><span class="nx">inst</span><span class="p">);</span></div><div class='line' id='LC368'>			<span class="k">if</span> <span class="p">(</span><span class="nx">$</span><span class="p">.</span><span class="nx">isFunction</span><span class="p">(</span><span class="nx">opts</span><span class="p">.</span><span class="nx">beforeShow</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC369'>				<span class="nx">opts</span><span class="p">.</span><span class="nx">beforeShow</span><span class="p">(</span><span class="nx">input</span><span class="p">,</span> <span class="nx">inst</span><span class="p">);</span></div><div class='line' id='LC370'>			<span class="p">}</span></div><div class='line' id='LC371'>		<span class="p">};</span></div><div class='line' id='LC372'><br/></div><div class='line' id='LC373'>		<span class="kd">var</span> <span class="nx">onChangeMonthYearFunc</span> <span class="o">=</span> <span class="kd">function</span><span class="p">(</span><span class="nx">year</span><span class="p">,</span> <span class="nx">month</span><span class="p">,</span> <span class="nx">inst</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC374'>			<span class="c1">// Update the time as well : this prevents the time from disappearing from the input field.</span></div><div class='line' id='LC375'>			<span class="nx">tp</span><span class="p">.</span><span class="nx">updateDateTime</span><span class="p">(</span><span class="nx">inst</span><span class="p">,</span> <span class="nx">tp</span><span class="p">);</span></div><div class='line' id='LC376'>			<span class="k">if</span> <span class="p">(</span><span class="nx">$</span><span class="p">.</span><span class="nx">isFunction</span><span class="p">(</span><span class="nx">opts</span><span class="p">.</span><span class="nx">onChangeMonthYear</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC377'>				<span class="nx">opts</span><span class="p">.</span><span class="nx">onChangeMonthYear</span><span class="p">(</span><span class="nx">year</span><span class="p">,</span> <span class="nx">month</span><span class="p">,</span> <span class="nx">inst</span><span class="p">);</span></div><div class='line' id='LC378'>			<span class="p">}</span></div><div class='line' id='LC379'>		<span class="p">};</span></div><div class='line' id='LC380'><br/></div><div class='line' id='LC381'>		<span class="kd">var</span> <span class="nx">onCloseFunc</span> <span class="o">=</span> <span class="kd">function</span><span class="p">(</span><span class="nx">dateText</span><span class="p">,</span> <span class="nx">inst</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC382'>			<span class="k">if</span><span class="p">(</span><span class="nx">tp</span><span class="p">.</span><span class="nx">timeDefined</span> <span class="o">===</span> <span class="kc">true</span> <span class="o">&amp;&amp;</span> <span class="nx">input</span><span class="p">.</span><span class="nx">val</span><span class="p">()</span> <span class="o">!=</span> <span class="s1">&#39;&#39;</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC383'>				<span class="nx">tp</span><span class="p">.</span><span class="nx">updateDateTime</span><span class="p">(</span><span class="nx">inst</span><span class="p">,</span> <span class="nx">tp</span><span class="p">);</span></div><div class='line' id='LC384'>			<span class="p">}</span></div><div class='line' id='LC385'>			<span class="k">if</span> <span class="p">(</span><span class="nx">$</span><span class="p">.</span><span class="nx">isFunction</span><span class="p">(</span><span class="nx">opts</span><span class="p">.</span><span class="nx">onClose</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC386'>				<span class="nx">opts</span><span class="p">.</span><span class="nx">onClose</span><span class="p">(</span><span class="nx">dateText</span><span class="p">,</span> <span class="nx">inst</span><span class="p">);</span></div><div class='line' id='LC387'>			<span class="p">}</span></div><div class='line' id='LC388'>		<span class="p">};</span></div><div class='line' id='LC389'><br/></div><div class='line' id='LC390'>		<span class="nx">tp</span><span class="p">.</span><span class="nx">defaults</span> <span class="o">=</span> <span class="nx">$</span><span class="p">.</span><span class="nx">extend</span><span class="p">({},</span> <span class="nx">tp</span><span class="p">.</span><span class="nx">defaults</span><span class="p">,</span> <span class="nx">opts</span><span class="p">,</span> <span class="p">{</span></div><div class='line' id='LC391'>			<span class="nx">beforeShow</span><span class="o">:</span> <span class="nx">beforeShowFunc</span><span class="p">,</span></div><div class='line' id='LC392'>			<span class="nx">onChangeMonthYear</span><span class="o">:</span> <span class="nx">onChangeMonthYearFunc</span><span class="p">,</span></div><div class='line' id='LC393'>			<span class="nx">onClose</span><span class="o">:</span> <span class="nx">onCloseFunc</span><span class="p">,</span></div><div class='line' id='LC394'>			<span class="nx">timepicker</span><span class="o">:</span> <span class="nx">tp</span> <span class="c1">// add timepicker as a property of datepicker: $.datepicker._get(dp_inst, &#39;timepicker&#39;);</span></div><div class='line' id='LC395'>		<span class="p">});</span></div><div class='line' id='LC396'><br/></div><div class='line' id='LC397'>		<span class="nx">$</span><span class="p">(</span><span class="k">this</span><span class="p">).</span><span class="nx">datepicker</span><span class="p">(</span><span class="nx">tp</span><span class="p">.</span><span class="nx">defaults</span><span class="p">);</span></div><div class='line' id='LC398'><br/></div><div class='line' id='LC399'>	<span class="p">};</span></div><div class='line' id='LC400'><br/></div><div class='line' id='LC401'>	<span class="c1">//########################################################################</span></div><div class='line' id='LC402'>	<span class="c1">// shorthand just to use timepicker..</span></div><div class='line' id='LC403'>	<span class="c1">//########################################################################</span></div><div class='line' id='LC404'>	<span class="nx">jQuery</span><span class="p">.</span><span class="nx">fn</span><span class="p">.</span><span class="nx">timepicker</span> <span class="o">=</span> <span class="kd">function</span><span class="p">(</span><span class="nx">opts</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC405'>		<span class="nx">opts</span> <span class="o">=</span> <span class="nx">$</span><span class="p">.</span><span class="nx">extend</span><span class="p">(</span><span class="nx">opts</span><span class="p">,</span> <span class="p">{</span> <span class="nx">timeOnly</span><span class="o">:</span> <span class="kc">true</span> <span class="p">});</span></div><div class='line' id='LC406'>		<span class="nx">$</span><span class="p">(</span><span class="k">this</span><span class="p">).</span><span class="nx">datetimepicker</span><span class="p">(</span><span class="nx">opts</span><span class="p">);</span></div><div class='line' id='LC407'>	<span class="p">};</span></div><div class='line' id='LC408'><br/></div><div class='line' id='LC409'>	<span class="c1">//########################################################################</span></div><div class='line' id='LC410'>	<span class="c1">// the bad hack :/ override datepicker so it doesnt close on select</span></div><div class='line' id='LC411'>	<span class="c1">// inspired: http://stackoverflow.com/questions/1252512/jquery-datepicker-prevent-closing-picker-when-clicking-a-date/1762378#1762378</span></div><div class='line' id='LC412'>	<span class="c1">//########################################################################</span></div><div class='line' id='LC413'>	<span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_base_selectDate</span> <span class="o">=</span> <span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_selectDate</span><span class="p">;</span></div><div class='line' id='LC414'>	<span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_selectDate</span> <span class="o">=</span> <span class="kd">function</span> <span class="p">(</span><span class="nx">id</span><span class="p">,</span> <span class="nx">dateStr</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC415'>		<span class="kd">var</span> <span class="nx">target</span> <span class="o">=</span> <span class="nx">$</span><span class="p">(</span><span class="nx">id</span><span class="p">);</span></div><div class='line' id='LC416'>		<span class="kd">var</span> <span class="nx">inst</span> <span class="o">=</span> <span class="k">this</span><span class="p">.</span><span class="nx">_getInst</span><span class="p">(</span><span class="nx">target</span><span class="p">[</span><span class="mi">0</span><span class="p">]);</span></div><div class='line' id='LC417'>		<span class="kd">var</span> <span class="nx">tp_inst</span> <span class="o">=</span> <span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_get</span><span class="p">(</span><span class="nx">inst</span><span class="p">,</span> <span class="s1">&#39;timepicker&#39;</span><span class="p">);</span></div><div class='line' id='LC418'><br/></div><div class='line' id='LC419'>		<span class="k">if</span><span class="p">(</span><span class="nx">tp_inst</span><span class="p">){</span></div><div class='line' id='LC420'>			<span class="nx">inst</span><span class="p">.</span><span class="nx">inline</span> <span class="o">=</span> <span class="kc">true</span><span class="p">;</span></div><div class='line' id='LC421'>			<span class="nx">inst</span><span class="p">.</span><span class="nx">stay_open</span> <span class="o">=</span> <span class="kc">true</span><span class="p">;</span></div><div class='line' id='LC422'>			<span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_base_selectDate</span><span class="p">(</span><span class="nx">id</span><span class="p">,</span> <span class="nx">dateStr</span><span class="p">);</span></div><div class='line' id='LC423'>			<span class="nx">inst</span><span class="p">.</span><span class="nx">stay_open</span> <span class="o">=</span> <span class="kc">false</span><span class="p">;</span></div><div class='line' id='LC424'>			<span class="nx">inst</span><span class="p">.</span><span class="nx">inline</span> <span class="o">=</span> <span class="kc">false</span><span class="p">;</span></div><div class='line' id='LC425'>			<span class="k">this</span><span class="p">.</span><span class="nx">_notifyChange</span><span class="p">(</span><span class="nx">inst</span><span class="p">);</span></div><div class='line' id='LC426'>			<span class="k">this</span><span class="p">.</span><span class="nx">_updateDatepicker</span><span class="p">(</span><span class="nx">inst</span><span class="p">);</span></div><div class='line' id='LC427'>		<span class="p">}</span></div><div class='line' id='LC428'>		<span class="k">else</span><span class="p">{</span></div><div class='line' id='LC429'>			<span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_base_selectDate</span><span class="p">(</span><span class="nx">id</span><span class="p">,</span> <span class="nx">dateStr</span><span class="p">);</span></div><div class='line' id='LC430'>		<span class="p">}</span></div><div class='line' id='LC431'>	<span class="p">};</span></div><div class='line' id='LC432'><br/></div><div class='line' id='LC433'>	<span class="c1">//#############################################################################################</span></div><div class='line' id='LC434'>	<span class="c1">// second bad hack :/ override datepicker so it triggers an event when changing the input field</span></div><div class='line' id='LC435'>	<span class="c1">// and does not redraw the datepicker on every selectDate event</span></div><div class='line' id='LC436'>	<span class="c1">//#############################################################################################</span></div><div class='line' id='LC437'>	<span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_base_updateDatepicker</span> <span class="o">=</span> <span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_updateDatepicker</span><span class="p">;</span></div><div class='line' id='LC438'>	<span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_updateDatepicker</span> <span class="o">=</span> <span class="kd">function</span><span class="p">(</span><span class="nx">inst</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC439'>		<span class="k">if</span> <span class="p">(</span><span class="k">typeof</span><span class="p">(</span><span class="nx">inst</span><span class="p">.</span><span class="nx">stay_open</span><span class="p">)</span> <span class="o">!==</span> <span class="s1">&#39;boolean&#39;</span> <span class="o">||</span> <span class="nx">inst</span><span class="p">.</span><span class="nx">stay_open</span> <span class="o">===</span> <span class="kc">false</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC440'>			<span class="k">this</span><span class="p">.</span><span class="nx">_base_updateDatepicker</span><span class="p">(</span><span class="nx">inst</span><span class="p">);</span></div><div class='line' id='LC441'>			<span class="c1">// Reload the time control when changing something in the input text field.</span></div><div class='line' id='LC442'>			<span class="k">this</span><span class="p">.</span><span class="nx">_beforeShow</span><span class="p">(</span><span class="nx">inst</span><span class="p">.</span><span class="nx">input</span><span class="p">,</span> <span class="nx">inst</span><span class="p">);</span></div><div class='line' id='LC443'>		<span class="p">}</span></div><div class='line' id='LC444'>	<span class="p">};</span></div><div class='line' id='LC445'><br/></div><div class='line' id='LC446'>	<span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_beforeShow</span> <span class="o">=</span> <span class="kd">function</span><span class="p">(</span><span class="nx">input</span><span class="p">,</span> <span class="nx">inst</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC447'>		<span class="kd">var</span> <span class="nx">beforeShow</span> <span class="o">=</span> <span class="k">this</span><span class="p">.</span><span class="nx">_get</span><span class="p">(</span><span class="nx">inst</span><span class="p">,</span> <span class="s1">&#39;beforeShow&#39;</span><span class="p">);</span></div><div class='line' id='LC448'>		<span class="k">if</span> <span class="p">(</span><span class="nx">beforeShow</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC449'>			<span class="nx">inst</span><span class="p">.</span><span class="nx">stay_open</span> <span class="o">=</span> <span class="kc">true</span><span class="p">;</span></div><div class='line' id='LC450'>			<span class="nx">beforeShow</span><span class="p">.</span><span class="nx">apply</span><span class="p">((</span><span class="nx">inst</span><span class="p">.</span><span class="nx">input</span> <span class="o">?</span> <span class="nx">inst</span><span class="p">.</span><span class="nx">input</span><span class="p">[</span><span class="mi">0</span><span class="p">]</span> <span class="o">:</span> <span class="kc">null</span><span class="p">),</span> <span class="p">[</span><span class="nx">inst</span><span class="p">.</span><span class="nx">input</span><span class="p">,</span> <span class="nx">inst</span><span class="p">]);</span></div><div class='line' id='LC451'>			<span class="nx">inst</span><span class="p">.</span><span class="nx">stay_open</span> <span class="o">=</span> <span class="kc">false</span><span class="p">;</span></div><div class='line' id='LC452'>		<span class="p">}</span></div><div class='line' id='LC453'>	<span class="p">};</span></div><div class='line' id='LC454'><br/></div><div class='line' id='LC455'>	<span class="c1">//#######################################################################################</span></div><div class='line' id='LC456'>	<span class="c1">// third bad hack :/ override datepicker so it allows spaces and colan in the input field</span></div><div class='line' id='LC457'>	<span class="c1">//#######################################################################################</span></div><div class='line' id='LC458'>	<span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_base_doKeyPress</span> <span class="o">=</span> <span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_doKeyPress</span><span class="p">;</span></div><div class='line' id='LC459'>	<span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_doKeyPress</span> <span class="o">=</span> <span class="kd">function</span><span class="p">(</span><span class="nx">event</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC460'>		<span class="kd">var</span> <span class="nx">inst</span> <span class="o">=</span> <span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_getInst</span><span class="p">(</span><span class="nx">event</span><span class="p">.</span><span class="nx">target</span><span class="p">);</span></div><div class='line' id='LC461'>		<span class="kd">var</span> <span class="nx">tp_inst</span> <span class="o">=</span> <span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_get</span><span class="p">(</span><span class="nx">inst</span><span class="p">,</span> <span class="s1">&#39;timepicker&#39;</span><span class="p">);</span></div><div class='line' id='LC462'><br/></div><div class='line' id='LC463'>		<span class="k">if</span><span class="p">(</span><span class="nx">tp_inst</span><span class="p">){</span></div><div class='line' id='LC464'>			<span class="k">if</span> <span class="p">(</span><span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_get</span><span class="p">(</span><span class="nx">inst</span><span class="p">,</span> <span class="s1">&#39;constrainInput&#39;</span><span class="p">))</span> <span class="p">{</span></div><div class='line' id='LC465'>				<span class="kd">var</span> <span class="nx">dateChars</span> <span class="o">=</span> <span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_possibleChars</span><span class="p">(</span><span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_get</span><span class="p">(</span><span class="nx">inst</span><span class="p">,</span> <span class="s1">&#39;dateFormat&#39;</span><span class="p">));</span></div><div class='line' id='LC466'>				<span class="kd">var</span> <span class="nx">chr</span> <span class="o">=</span> <span class="nb">String</span><span class="p">.</span><span class="nx">fromCharCode</span><span class="p">(</span><span class="nx">event</span><span class="p">.</span><span class="nx">charCode</span> <span class="o">===</span> <span class="kc">undefined</span> <span class="o">?</span> <span class="nx">event</span><span class="p">.</span><span class="nx">keyCode</span> <span class="o">:</span> <span class="nx">event</span><span class="p">.</span><span class="nx">charCode</span><span class="p">);</span></div><div class='line' id='LC467'>				<span class="kd">var</span> <span class="nx">chrl</span> <span class="o">=</span> <span class="nx">chr</span><span class="p">.</span><span class="nx">toLowerCase</span><span class="p">();</span></div><div class='line' id='LC468'>				<span class="c1">// keyCode == 58 =&gt; ":"</span></div><div class='line' id='LC469'>				<span class="c1">// keyCode == 32 =&gt; " "</span></div><div class='line' id='LC470'>				<span class="k">return</span> <span class="nx">event</span><span class="p">.</span><span class="nx">ctrlKey</span> <span class="o">||</span> <span class="p">(</span><span class="nx">chr</span> <span class="o">&lt;</span> <span class="s1">&#39; &#39;</span> <span class="o">||</span> <span class="o">!</span><span class="nx">dateChars</span> <span class="o">||</span> <span class="nx">dateChars</span><span class="p">.</span><span class="nx">indexOf</span><span class="p">(</span><span class="nx">chr</span><span class="p">)</span> <span class="o">&gt;</span> <span class="o">-</span><span class="mi">1</span> <span class="o">||</span> <span class="nx">event</span><span class="p">.</span><span class="nx">keyCode</span> <span class="o">==</span> <span class="mi">58</span> <span class="o">||</span> <span class="nx">event</span><span class="p">.</span><span class="nx">keyCode</span> <span class="o">==</span> <span class="mi">32</span> <span class="o">||</span> <span class="nx">chr</span> <span class="o">==</span> <span class="s1">&#39;:&#39;</span> <span class="o">||</span> <span class="nx">chr</span> <span class="o">==</span> <span class="s1">&#39; &#39;</span> <span class="o">||</span> <span class="nx">chrl</span> <span class="o">==</span> <span class="s1">&#39;a&#39;</span> <span class="o">||</span> <span class="nx">chrl</span> <span class="o">==</span> <span class="s1">&#39;p&#39;</span> <span class="o">||</span> <span class="nx">charl</span> <span class="o">==</span> <span class="s1">&#39;m&#39;</span><span class="p">);</span></div><div class='line' id='LC471'>			<span class="p">}</span></div><div class='line' id='LC472'>		<span class="p">}</span></div><div class='line' id='LC473'>		<span class="k">else</span><span class="p">{</span></div><div class='line' id='LC474'>			<span class="k">return</span> <span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_base_doKeyPress</span><span class="p">(</span><span class="nx">event</span><span class="p">);</span></div><div class='line' id='LC475'>		<span class="p">}</span></div><div class='line' id='LC476'><br/></div><div class='line' id='LC477'>	<span class="p">};</span></div><div class='line' id='LC478'><br/></div><div class='line' id='LC479'>	<span class="c1">//#######################################################################################</span></div><div class='line' id='LC480'>	<span class="c1">// override "Today" button to also grab the time.</span></div><div class='line' id='LC481'>	<span class="c1">//#######################################################################################</span></div><div class='line' id='LC482'>	<span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_base_gotoToday</span> <span class="o">=</span> <span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_gotoToday</span><span class="p">;</span></div><div class='line' id='LC483'>	<span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_gotoToday</span> <span class="o">=</span> <span class="kd">function</span><span class="p">(</span><span class="nx">id</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC484'>		<span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_base_gotoToday</span><span class="p">(</span><span class="nx">id</span><span class="p">);</span></div><div class='line' id='LC485'><br/></div><div class='line' id='LC486'>		<span class="kd">var</span> <span class="nx">target</span> <span class="o">=</span> <span class="nx">$</span><span class="p">(</span><span class="nx">id</span><span class="p">);</span></div><div class='line' id='LC487'>		<span class="kd">var</span> <span class="nx">dp_inst</span> <span class="o">=</span> <span class="k">this</span><span class="p">.</span><span class="nx">_getInst</span><span class="p">(</span><span class="nx">target</span><span class="p">[</span><span class="mi">0</span><span class="p">]);</span></div><div class='line' id='LC488'>		<span class="kd">var</span> <span class="nx">tp_inst</span> <span class="o">=</span> <span class="nx">$</span><span class="p">.</span><span class="nx">datepicker</span><span class="p">.</span><span class="nx">_get</span><span class="p">(</span><span class="nx">dp_inst</span><span class="p">,</span> <span class="s1">&#39;timepicker&#39;</span><span class="p">);</span></div><div class='line' id='LC489'><br/></div><div class='line' id='LC490'>		<span class="k">if</span><span class="p">(</span><span class="nx">tp_inst</span><span class="p">){</span></div><div class='line' id='LC491'>			<span class="kd">var</span> <span class="nx">date</span> <span class="o">=</span> <span class="k">new</span> <span class="nb">Date</span><span class="p">();</span></div><div class='line' id='LC492'>			<span class="kd">var</span> <span class="nx">hour</span> <span class="o">=</span> <span class="nx">date</span><span class="p">.</span><span class="nx">getHours</span><span class="p">();</span></div><div class='line' id='LC493'>			<span class="kd">var</span> <span class="nx">minute</span> <span class="o">=</span> <span class="nx">date</span><span class="p">.</span><span class="nx">getMinutes</span><span class="p">();</span></div><div class='line' id='LC494'>			<span class="kd">var</span> <span class="nx">second</span> <span class="o">=</span> <span class="nx">date</span><span class="p">.</span><span class="nx">getSeconds</span><span class="p">();</span></div><div class='line' id='LC495'><br/></div><div class='line' id='LC496'>			<span class="c1">//check if within min/max times..</span></div><div class='line' id='LC497'>			<span class="k">if</span><span class="p">(</span> <span class="p">(</span><span class="nx">hour</span> <span class="o">&lt;</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">defaults</span><span class="p">.</span><span class="nx">hourMin</span> <span class="o">||</span> <span class="nx">hour</span> <span class="o">&gt;</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">defaults</span><span class="p">.</span><span class="nx">hourMax</span><span class="p">)</span> <span class="o">||</span> <span class="p">(</span><span class="nx">minute</span> <span class="o">&lt;</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">defaults</span><span class="p">.</span><span class="nx">minuteMin</span> <span class="o">||</span> <span class="nx">minute</span> <span class="o">&gt;</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">defaults</span><span class="p">.</span><span class="nx">minuteMax</span><span class="p">)</span> <span class="o">||</span> <span class="p">(</span><span class="nx">second</span> <span class="o">&lt;</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">defaults</span><span class="p">.</span><span class="nx">secondMin</span> <span class="o">||</span> <span class="nx">second</span> <span class="o">&gt;</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">defaults</span><span class="p">.</span><span class="nx">secondMax</span><span class="p">)</span> <span class="p">){</span>					</div><div class='line' id='LC498'>				<span class="nx">hour</span> <span class="o">=</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">defaults</span><span class="p">.</span><span class="nx">hourMin</span><span class="p">;</span></div><div class='line' id='LC499'>				<span class="nx">minute</span> <span class="o">=</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">defaults</span><span class="p">.</span><span class="nx">minuteMin</span><span class="p">;</span></div><div class='line' id='LC500'>				<span class="nx">second</span> <span class="o">=</span> <span class="nx">tp_inst</span><span class="p">.</span><span class="nx">defaults</span><span class="p">.</span><span class="nx">secondMin</span><span class="p">;</span>				</div><div class='line' id='LC501'>			<span class="p">}</span></div><div class='line' id='LC502'><br/></div><div class='line' id='LC503'>			<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">hour_slider</span><span class="p">.</span><span class="nx">slider</span><span class="p">(</span><span class="s1">&#39;value&#39;</span><span class="p">,</span> <span class="nx">hour</span> <span class="p">);</span></div><div class='line' id='LC504'>			<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">minute_slider</span><span class="p">.</span><span class="nx">slider</span><span class="p">(</span><span class="s1">&#39;value&#39;</span><span class="p">,</span> <span class="nx">minute</span> <span class="p">);</span></div><div class='line' id='LC505'>			<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">second_slider</span><span class="p">.</span><span class="nx">slider</span><span class="p">(</span><span class="s1">&#39;value&#39;</span><span class="p">,</span> <span class="nx">second</span> <span class="p">);</span></div><div class='line' id='LC506'><br/></div><div class='line' id='LC507'>			<span class="nx">tp_inst</span><span class="p">.</span><span class="nx">onTimeChange</span><span class="p">(</span><span class="nx">dp_inst</span><span class="p">,</span> <span class="nx">tp_inst</span><span class="p">);</span></div><div class='line' id='LC508'>		<span class="p">}</span></div><div class='line' id='LC509'>	<span class="p">};</span></div><div class='line' id='LC510'><br/></div><div class='line' id='LC511'>	<span class="c1">//#######################################################################################</span></div><div class='line' id='LC512'>	<span class="c1">// jQuery extend now ignores nulls!</span></div><div class='line' id='LC513'>	<span class="c1">//#######################################################################################</span></div><div class='line' id='LC514'>	<span class="kd">function</span> <span class="nx">extendRemove</span><span class="p">(</span><span class="nx">target</span><span class="p">,</span> <span class="nx">props</span><span class="p">)</span> <span class="p">{</span></div><div class='line' id='LC515'>		<span class="nx">$</span><span class="p">.</span><span class="nx">extend</span><span class="p">(</span><span class="nx">target</span><span class="p">,</span> <span class="nx">props</span><span class="p">);</span></div><div class='line' id='LC516'>		<span class="k">for</span> <span class="p">(</span><span class="kd">var</span> <span class="nx">name</span> <span class="k">in</span> <span class="nx">props</span><span class="p">)</span></div><div class='line' id='LC517'>			<span class="k">if</span> <span class="p">(</span><span class="nx">props</span><span class="p">[</span><span class="nx">name</span><span class="p">]</span> <span class="o">==</span> <span class="kc">null</span> <span class="o">||</span> <span class="nx">props</span><span class="p">[</span><span class="nx">name</span><span class="p">]</span> <span class="o">==</span> <span class="kc">undefined</span><span class="p">)</span></div><div class='line' id='LC518'>				<span class="nx">target</span><span class="p">[</span><span class="nx">name</span><span class="p">]</span> <span class="o">=</span> <span class="nx">props</span><span class="p">[</span><span class="nx">name</span><span class="p">];</span></div><div class='line' id='LC519'>		<span class="k">return</span> <span class="nx">target</span><span class="p">;</span></div><div class='line' id='LC520'>	<span class="p">};</span></div><div class='line' id='LC521'><br/></div><div class='line' id='LC522'>	<span class="nx">$</span><span class="p">.</span><span class="nx">timepicker</span> <span class="o">=</span> <span class="k">new</span> <span class="nx">Timepicker</span><span class="p">(</span><span class="kc">true</span><span class="p">);</span> <span class="c1">// singleton instance</span></div><div class='line' id='LC523'><span class="p">})(</span><span class="nx">jQuery</span><span class="p">);</span></div><div class='line' id='LC524'><br/></div><div class='line' id='LC525'><br/></div></pre></div>
            
          </td>
        </tr>
      </table>
    
  </div>


      </div>
    </div>

  


    </div>
  
      
    </div>

    <div id="footer" class="clearfix">
      <div class="site">
        <div class="sponsor">
          <a href="http://www.rackspace.com" class="logo">
            <img alt="Dedicated Server" src="http://assets3.github.com/images/modules/footer/rackspace_logo.png?accc094c859fe2c8c9c94e58a43e0af05c44b8fd" />
          </a>
          Powered by the <a href="http://www.rackspace.com ">Dedicated
          Servers</a> and<br/> <a href="http://www.rackspacecloud.com">Cloud
          Computing</a> of Rackspace Hosting<span>&reg;</span>
        </div>

        <ul class="links">
          <li class="blog"><a href="http://github.com/blog">Blog</a></li>
          <li><a href="http://support.github.com">Support</a></li>
          <li><a href="http://github.com/training">Training</a></li>
          <li><a href="http://jobs.github.com">Job Board</a></li>
          <li><a href="http://shop.github.com">Shop</a></li>
          <li><a href="http://github.com/contact">Contact</a></li>
          <li><a href="http://develop.github.com">API</a></li>
          <li><a href="http://status.github.com">Status</a></li>
        </ul>
        <ul class="sosueme">
          <li class="main">&copy; 2010 <span id="_rrt" title="0.07993s from fe3.rs.github.com">GitHub</span> Inc. All rights reserved.</li>
          <li><a href="/site/terms">Terms of Service</a></li>
          <li><a href="/site/privacy">Privacy</a></li>
          <li><a href="http://github.com/security">Security</a></li>
        </ul>
      </div>
    </div><!-- /#footer -->

    
      
      
        <!-- current locale:  -->
        <div class="locales">
          <div class="site">

            <ul class="choices clearfix limited-locales">
              <li><span class="current">English</span></li>
              
                
                  <li><a rel="nofollow" href="?locale=de">Deutsch</a></li>
                
              
                
                  <li><a rel="nofollow" href="?locale=fr">Français</a></li>
                
              
                
                  <li><a rel="nofollow" href="?locale=ja">日本語</a></li>
                
              
                
                  <li><a rel="nofollow" href="?locale=pt-BR">Português (BR)</a></li>
                
              
                
                  <li><a rel="nofollow" href="?locale=ru">Русский</a></li>
                
              
                
                  <li><a rel="nofollow" href="?locale=zh">中文</a></li>
                
              
              <li class="all"><a href="#" class="minibutton btn-forward js-all-locales"><span><span class="icon"></span>See all available languages</span></a></li>
            </ul>

            <div class="all-locales clearfix">
              <h3>Your current locale selection: <strong>English</strong>. Choose another?</h3>
              
              
                <ul class="choices">
                  
                    
                      <li><a rel="nofollow" href="?locale=en">English</a></li>
                    
                  
                    
                      <li><a rel="nofollow" href="?locale=af">Afrikaans</a></li>
                    
                  
                    
                      <li><a rel="nofollow" href="?locale=ca">Català</a></li>
                    
                  
                    
                      <li><a rel="nofollow" href="?locale=cs">Čeština</a></li>
                    
                  
                </ul>
              
                <ul class="choices">
                  
                    
                      <li><a rel="nofollow" href="?locale=de">Deutsch</a></li>
                    
                  
                    
                      <li><a rel="nofollow" href="?locale=es">Español</a></li>
                    
                  
                    
                      <li><a rel="nofollow" href="?locale=fr">Français</a></li>
                    
                  
                    
                      <li><a rel="nofollow" href="?locale=hr">Hrvatski</a></li>
                    
                  
                </ul>
              
                <ul class="choices">
                  
                    
                      <li><a rel="nofollow" href="?locale=id">Indonesia</a></li>
                    
                  
                    
                      <li><a rel="nofollow" href="?locale=it">Italiano</a></li>
                    
                  
                    
                      <li><a rel="nofollow" href="?locale=ja">日本語</a></li>
                    
                  
                    
                      <li><a rel="nofollow" href="?locale=nl">Nederlands</a></li>
                    
                  
                </ul>
              
                <ul class="choices">
                  
                    
                      <li><a rel="nofollow" href="?locale=no">Norsk</a></li>
                    
                  
                    
                      <li><a rel="nofollow" href="?locale=pl">Polski</a></li>
                    
                  
                    
                      <li><a rel="nofollow" href="?locale=pt-BR">Português (BR)</a></li>
                    
                  
                    
                      <li><a rel="nofollow" href="?locale=ru">Русский</a></li>
                    
                  
                </ul>
              
                <ul class="choices">
                  
                    
                      <li><a rel="nofollow" href="?locale=sr">Српски</a></li>
                    
                  
                    
                      <li><a rel="nofollow" href="?locale=sv">Svenska</a></li>
                    
                  
                    
                      <li><a rel="nofollow" href="?locale=zh">中文</a></li>
                    
                  
                </ul>
              
            </div>

          </div>
          <div class="fade"></div>
        </div>
      
    

    <script>window._auth_token = "b1eecce999f3ac832295b735c0071a3b4ec4e6b0"</script>
    <div id="keyboard_shortcuts_pane" style="display:none">
  <h2>Keyboard Shortcuts</h2>

  <div class="columns threecols">
    <div class="column first">
      <h3>Site wide shortcuts</h3>
      <dl class="keyboard-mappings">
        <dt>s</dt>
        <dd>Focus site search</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>?</dt>
        <dd>Bring up this help dialog</dd>
      </dl>
    </div><!-- /.column.first -->
    <div class="column middle">
      <h3>Commit list</h3>
      <dl class="keyboard-mappings">
        <dt>j</dt>
        <dd>Move selected down</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>k</dt>
        <dd>Move selected up</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>t</dt>
        <dd>Open tree</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>p</dt>
        <dd>Open parent</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>c <em>or</em> o <em>or</em> enter</dt>
        <dd>Open commit</dd>
      </dl>
    </div><!-- /.column.first -->
    <div class="column last">
      <h3>Pull request list</h3>
      <dl class="keyboard-mappings">
        <dt>j</dt>
        <dd>Move selected down</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>k</dt>
        <dd>Move selected up</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>o <em>or</em> enter</dt>
        <dd>Open issue</dd>
      </dl>
    </div><!-- /.columns.last -->
  </div><!-- /.columns.equacols -->

  <div class="rule"></div>

  <h3>Issues</h3>

  <div class="columns threecols">
    <div class="column first">
      <dl class="keyboard-mappings">
        <dt>j</dt>
        <dd>Move selected down</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>k</dt>
        <dd>Move selected up</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>x</dt>
        <dd>Toggle select target</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>o <em>or</em> enter</dt>
        <dd>Open issue</dd>
      </dl>
    </div><!-- /.column.first -->
    <div class="column middle">
      <dl class="keyboard-mappings">
        <dt>I</dt>
        <dd>Mark selected as read</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>U</dt>
        <dd>Mark selected as unread</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>e</dt>
        <dd>Close selected</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>y</dt>
        <dd>Remove selected from view</dd>
      </dl>
    </div><!-- /.column.middle -->
    <div class="column last">
      <dl class="keyboard-mappings">
        <dt>c</dt>
        <dd>Create issue</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>l</dt>
        <dd>Create label</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>i</dt>
        <dd>Back to inbox</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>u</dt>
        <dd>Back to issues</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>/</dt>
        <dd>Focus issues search</dd>
      </dl>
    </div>
  </div>

  <div class="rule"></div>

  <h3>Network Graph</h3>
  <div class="columns equacols">
    <div class="column first">
      <dl class="keyboard-mappings">
        <dt>← <em>or</em> h</dt>
        <dd>Scroll left</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>→ <em>or</em> l</dt>
        <dd>Scroll right</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>↑ <em>or</em> k</dt>
        <dd>Scroll up</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>↓ <em>or</em> j</dt>
        <dd>Scroll down</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>t</dt>
        <dd>Toggle visibility of head labels</dd>
      </dl>
    </div><!-- /.column.first -->
    <div class="column last">
      <dl class="keyboard-mappings">
        <dt>shift ← <em>or</em> shift h</dt>
        <dd>Scroll all the way left</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>shift → <em>or</em> shift l</dt>
        <dd>Scroll all the way right</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>shift ↑ <em>or</em> shift k</dt>
        <dd>Scroll all the way up</dd>
      </dl>
      <dl class="keyboard-mappings">
        <dt>shift ↓ <em>or</em> shift j</dt>
        <dd>Scroll all the way down</dd>
      </dl>
    </div><!-- /.column.last -->
  </div>

</div>
    

    <!--[if IE 8]>
    <script type="text/javascript" charset="utf-8">
      $(document.body).addClass("ie8")
    </script>
    <![endif]-->

    <!--[if IE 7]>
    <script type="text/javascript" charset="utf-8">
      $(document.body).addClass("ie7")
    </script>
    <![endif]-->

    <script type="text/javascript">
      _kmq.push(['trackClick', 'entice_banner_link', 'Entice banner clicked']);
      
    </script>
    
  </body>
</html>

