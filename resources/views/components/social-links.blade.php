<ul class="footer-social">
    @if ($socialLinks->facebook !== null)
    <li><a target="_blank" href="{{$socialLinks->facebook}}" class="facebook"><i class="fa fa-facebook"></i></a></li>    
    @endif

    @if ($socialLinks->twitter !== null)
    <li><a target="_blank" href="{{$socialLinks->twitter}}" class="twitter"><i class="fa fa-twitter"></i></a></li>    
    @endif

    @if ($socialLinks->instagram !== null)
    <li><a target="_blank" href="{{$socialLinks->instagram}}" class="instagram"><i class="fa fa-instagram"></i></a></li>
    @endif

    @if ($socialLinks->youtube !== null)
    <li><a target="_blank" href="{{$socialLinks->youtube}}" class="youtube"><i class="fa fa-youtube"></i></a></li>
    @endif

    @if ($socialLinks->linkedin !== null)
    <li><a target="_blank" href="{{$socialLinks->linkedin}}" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
    @endif
</ul>