<?php include 'layouts/header.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">

                    <div class="text-center mb-4">
                        <span style="font-size: 3rem;">🔮</span>
                        <h2 class="fw-bold mt-2">Consulta de Signo</h2>
                        <p class="text-muted">Digite sua data de nascimento e descubra seu signo zodiacal.</p>
                    </div>

                    <form action="show_zodiac_sign.php" method="POST">
                        <div class="mb-4">
                            <label for="data_nascimento" class="form-label fw-semibold">
                                📅 Data de Nascimento
                            </label>
                            <input
                                type="date"
                                class="form-control form-control-lg rounded-3"
                                id="data_nascimento"
                                name="data_nascimento"
                                required
                            />
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg rounded-3">
                                ✨ Descobrir meu signo
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>
