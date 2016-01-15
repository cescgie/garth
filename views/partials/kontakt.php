  <div class="row">
    <div class="col s12 l12 m12">
      <div class="body_text">

        <div class="div_head">
          <p class="p_kontakt">Astrid Garth</p>
          <p class="p_kontakt">Pfarrstrasse 8</p>
          <p class="p_kontakt">55262 Heidesheim</p>
          <p class="p_kontakt">Telefon: 06132 - 56 322</p>
          <p class="p_kontakt">Mobil: 0176 – 513 59 763</p>
        </div>

        <div class="div_kontakt">
          <p class="strong">
            Haben die Bilder Ihr Interesse geweckt?
          </p>
          <p>
            Man kann mich natürlich auch buchen...
          </p>
          <p>
            Mit über 20 Jahren Berufserfahrung bin ich genau die Richtige für eine stimmungsvolle Reportage Ihres Firmenevents
          </p>
          <p>
            oder aussagekräftige Werbeaufnahmen Ihres Unternehmens. Gerne begleite ich auch Ihre Hochzeit oder erstelle einfühlsame Portraitserien.
            Für Preis- und Terminanfragen schicken Sie mir einfach eine E-Mail oder rufen Sie an.
          </p>
        </div>
      </div>

      <div class="widget-upload" style="margin-top:50px;">
        <?php echo Message::show(); ?>
        <form action="<?= DIR?>kontakt/send" method="post">
          <div class="row">
            <div class="col l12 m12 s12">
                <h4 class="strong center" style="color:#000">Kontaktformular</h4>
                <div class="input-field col s12">
                  <i class="material-icons prefix icon-color">account_circle</i>
                  <input id="name" type="text" name="name" class="validate">
                  <label for="name">Name</label>
                </div>
                <div class="input-field col s12">
                  <i class="material-icons prefix icon-color">email</i>
                    <input id="email" type="email" name="email" class="validate">
                    <label for="email">Email</label>
                </div>
                <div class="input-field col s12">
                  <i class="material-icons prefix icon-color">mode_edit</i>
                  <textarea id="textarea_kontakt" name="textarea_kontakt" class="materialize-textarea" length="500"></textarea>
                  <label for="textarea_kontakt">Textarea</label>
                </div>
                <div class="right">
                  <input class="btn waves-effect waves-light submit_kontakt" type="submit" value="Absenden" id="submit_kontakt">
                </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
