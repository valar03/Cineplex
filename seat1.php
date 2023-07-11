<div class="container">

    <div class="container">
        <form method="POST">
            <label for="form-control" style="font-weight: bold;">Seat Numbers:</label>
            <input type="text" readonly="readonly" class="form-control" id="demo" name="booked_seats" value="">
            <label for="form-control" style="font-weight: bold;">Number of Seats:</label>
            <input type="text" readonly="readonly" class="form-control" id="count" name="count" value="">
            <br>
            <div class="jumbotron">
                <?php foreach ($seats as $seat => $val): ?>
                    <?php if ($val >= 1): ?>
                        <input type="image" onclick="bookSeat(this.id)" disabled="true" id="<?php echo $seat; ?>" value="<?php echo $seat; ?>" src="<?php echo static_url('bk.png'); ?>" style="height: 80px; width: 80px;"/>
                    <?php else: ?>
                        <input type="image" onclick="bookSeat(this.id)" id="<?php echo $seat; ?>" value="<?php echo $seat; ?>" src="<?php echo static_url('seat.png'); ?>" style="height: 80px; width: 80px;"/>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="container">
                <button class="btn btn-danger" onclick="location.reload()" style="width: 70%; position: absolute; margin-left: 120px;">Clear Booked seats</button>
                <br>
                <br>
                <input type="submit" class="btn btn-success" style="width: 70%; position: absolute;margin-left: 120px;" value="Confirm Booking">
            </div>
        </form>
        <br>
    </div>
</div>
<br>
<br>

<script>
    function bookSeat(id)
    {
        document.getElementById('demo').value += document.getElementById(id).value+",";
        document.getElementById(id).src = "<?php echo static_url('booked.png'); ?>";
        document.getElementById(id).disabled = true;

        var val = document.getElementById("count").value;

        if(val)
        {
            val = parseInt(val)+1;
            document.getElementById("count").value = val;
        }
        else{
            document.getElementById("count").value = 1;
        }
    }
</script>
