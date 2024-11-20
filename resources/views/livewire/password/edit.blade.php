<div class="row p-4 pt-5 justify-content-center">
    <div class="col-md-7">

        <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title"><i class="fas fa-edit fa-2x"></i> Formulaire de modification du mot de passe</h3>
        </div>
        
        
        <form role="form" wire:submit.prevent="updatePassword">
        <div class="card-body">

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Entrer l'ancien mot de passe</label>
                    <input type="password" class="form-control @error('oldpassword')  is-invalid  @enderror" wire:model="oldpassword">
                    @error('oldpassword')
                       <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Entrer le nouveau mot de passe</label>
                    <input type="password" class="form-control @error('newpassword')  is-invalid  @enderror" wire:model="newpassword">
                    @error('newpassword')
                       <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>

        </div>
        
        <div class="card-footer">
        <button type="submit" class="btn btn-primary">Modifier</button>
        </div>
        </form>
        </div>
        
        </div>
</div>