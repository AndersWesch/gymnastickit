<div id="app" style="max-width: 414px; height: 100%; background-color: #f7f7f7; padding: 25px; margin: auto;">

    <h1 class="text-center"><a href="/"><span style="color: #2f7dde">gymna</span><span style="color: #de2f2f">Stick It</span></a></h1>

    <div class="row" style="padding-top: 10%;">
        <h2>Who & Why</h2>
        <p>
            My name is Anders Wesch and I am an old gymnast who loves Stick Its.
            I'm now a software engineer and found it fun to make this game to spread the joy of gymnastics.
        </p>

        <h2>Contact</h2>
        <p>If you have any questions or suggestions don't hesitate to shoot me an email:</p>
        <div class="text-center">
            <a href="mailto:anderswesch@gmail.com">write it here</a>
        </div>

        <br><br>

        <h2>Can I get my own level?</h2>
        <p>Yes - write to me</p>
    </div>

    <footer v-if="status == 'HOME'" class="footer" style="position: fixed; bottom: 25px; width: 87%">
        <?php include('components/footer.php'); ?>
    </footer>
</div>
