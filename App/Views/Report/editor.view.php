<?php

/** @var \Framework\Support\LinkGenerator $link */
?>

<link rel="stylesheet" href="<?= $link->asset('css/editor.css') ?>">

<h1>Edit reportu: názov</h1>

<div class="editor">
    <aside class="toolbar" aria-label="Panel nástrojov">
        <button type="button" class="tool active" aria-pressed="true">
            <span class="tool-icon">
                <img src="<?= $link->asset('images/mouse-pointer.png') ?>" alt="Mouse pointer">
            </span>
            Výber
        </button>
        <button type="button" class="tool" aria-pressed="false">
            <span class="tool-icon">
                <img src="<?= $link->asset('images/line-chart.png') ?>" alt="Line">
            </span>
            Čiara
        </button>
        <button type="button" class="tool" aria-pressed="false">
            <span class="tool-icon">
                <img src="<?= $link->asset('images/square.png') ?>" alt="Rectangle">
            </span>
            Obdĺžnik
        </button>
        <button type="button" class="tool" aria-pressed="false">
            <span class="tool-icon">
                <img src="<?= $link->asset('images/circle.png') ?>" alt="Circle">
            </span>
            Kruh
        </button>
        <button type="button" class="tool" aria-pressed="false">
            <span class="tool-icon">
                <img src="<?= $link->asset('images/text.png') ?>" alt="Text">
            </span>
            Text
        </button>
        <button type="button" class="tool" aria-pressed="false">
            <span class="tool-icon">
                <img src="<?= $link->asset('images/sensor.png') ?>" alt="Sensor">
            </span>
            Senzor
        </button>
    </aside>

    <section class="canvas-area" aria-label="Plátno reportu">
        <div class="canvas">Plátno</div>
        <p class="canvas-size">Rozmery: 1280 x 720 px</p>
    </section>

    <aside class="properties" aria-label="Vlastnosti prvku">
        <form action="#" method="post">

            <fieldset>
                <legend>Vlastnosti prvku</legend>
                <div class="field-grid">
                    <div class="field">
                        <label for="width">Šírka</label>
                        <input type="number" id="width" name="width" value="220">
                    </div>
                    <div class="field">
                        <label for="height">Výška</label>
                        <input type="number" id="height" name="height" value="120">
                    </div>
                    <div class="field">
                        <label for="pos-x">X</label>
                        <input type="number" id="pos-x" name="x" value="120">
                    </div>
                    <div class="field">
                        <label for="pos-y">Y</label>
                        <input type="number" id="pos-y" name="y" value="80">
                    </div>
                    <div class="field">
                        <label for="fill">Farba výplne</label>
                        <input type="color" id="fill" name="fill" value="#fff8ee">
                    </div>
                    <div class="field">
                        <label for="stroke">Farba obrysu</label>
                        <input type="color" id="stroke" name="stroke" value="#4a403a">
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Senzor</legend>
                <div class="field">
                    <label for="sensor">Vybrať senzor</label>
                    <select id="sensor" name="sensor">
                        <option>Teplota</option>
                        <option>Vlhkosť</option>
                        <option>Rýchlosť vetra</option>
                    </select>
                </div>
                <div class="field">
                    <label for="location">Vybrať lokalitu</label>
                    <select id="location" name="location">
                        <option>Žilina</option>
                        <option>Bratislava</option>
                        <option>Košice</option>
                    </select>
                </div>
            </fieldset>

            <fieldset class="options">
                <legend>Možnosti</legend>
                <div class="actions">
                    <button type="submit" class="btn btn-primary">Uložiť</button>
                    <button type="button" class="btn">Kiosk</button>
                </div>
            </fieldset>

        </form>
    </aside>

</div>
