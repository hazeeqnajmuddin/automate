import os
import joblib
import pandas as pd
import numpy as np
from fastapi import FastAPI, HTTPException
from pydantic import BaseModel

app = FastAPI(title="AutoMate AI Diagnostic Engine")

# --- CONFIGURATION ---
MODEL_DIR = r"C:\Users\hazee\Documents\Jupyter Projects\AutoMate_AI\notebooks"

# --- MODEL LOADING ---
try:
    model_scheduler = joblib.load(os.path.join(MODEL_DIR, 'Scheduler_Tree.pkl'))
    model_wear_tear = joblib.load(os.path.join(MODEL_DIR, 'WearTear_Tree.pkl'))
    model_doctor    = joblib.load(os.path.join(MODEL_DIR, 'Doctor_Tree.pkl'))
    print("✅ All Decision Tree models loaded with 19-feature support.")
except Exception as e:
    print(f"❌ Error loading models: {str(e)}")

# --- DATA SCHEMA ---
class VehicleFeatures(BaseModel):
    age: float
    fuel_type: int
    transmission_type: int
    engine_size: float
    mileage: int
    tyre_tread: int
    brake_effectiveness: int
    brand: int
    model: int
    registered_year: float
    engine_noise: int
    engine_light: float
    battery_light_on: int
    problem_description: str = ""

@app.post("/predict")
def predict_maintenance(data: VehicleFeatures):
    try:
        # OVERRIDE LOGIC BASED ON YOUR TRAINING DATA
        # Initialize symptoms based on keyword detection
        symptoms = {
            'ac_warm': 0,
            'engine_noise': 0,
            'oil_cap': 0,
            'knocking': 0,
            'unstable': 0,
            'washer': 0
        }
        
        # Local copies of existing features for potential overrides
        current_brake = data.brake_effectiveness
        current_battery_light = data.battery_light_on

        if data.problem_description:
            text = data.problem_description.lower()
            
            # Symptom: A/C Issues (target_aircond_gastopup)
            if any(w in text for w in ["hot", "warm", "ac", "aircond", "sweat"]):
                symptoms['ac_warm'] = 1
                
            # Symptom: Engine Noise
            if any(w in text for w in ["loud", "ticking", "engine noise", "rattle", "noise from engine"]):
                symptoms['engine_noise'] = 1
                
            # Symptom: Oil Leak/Cap (target_oil_cap)
            if any(w in text for w in ["leak", "cap", "puddle", "drip", "oil on floor"]):
                symptoms['oil_cap'] = 1
                
            # Symptom: Knocking (target_lower_arm / target_stabilizer_link)
            if any(w in text for w in ["knock", "clunk", "thud", "suspension", "bump"]):
                symptoms['knocking'] = 1
                
            # Symptom: Unstable Handling (target_wheel_alignment)
            if any(w in text for w in ["shake", "vibrate", "steering", "wobbly", "pulling"]):
                symptoms['unstable'] = 1
                
            # Symptom: Washer Motor (target_motor_washer)
            if any(w in text for w in ["washer", "spray", "wiper", "windshield"]):
                symptoms['washer'] = 1

            # Feature Overrides: Brakes & Battery
            if any(w in text for w in ["brake", "stop", "screech", "squeak"]):
                current_brake = 1 # Set to Low Effectiveness (1)
            
            if any(w in text for w in ["battery", "cannot start", "dead", "crank"]):
                current_battery_light = 1 # Set Battery Light On

        # 2. CONSTRUCT INPUT DICTIONARY (MATCHES master_training_data_final.csv ORDER)
        input_dict = {
            'age': [data.age],
            'fuel_type': [data.fuel_type],
            'transmission_type': [data.transmission_type],
            'engine_size': [data.engine_size],
            'mileage': [data.mileage],
            'tyre_tread': [data.tyre_tread],
            'brake_effectiveness': [current_brake],
            'brand': [data.brand],
            'model': [data.model],
            'registered_year': [data.registered_year],
            'engine_noise': [data.engine_noise],
            'engine_light': [data.engine_light],

            'symptom_ac_warm': [symptoms['ac_warm']],
            'symptom_engine_noise': [symptoms['engine_noise']],
            'symptom_oil_cap': [symptoms['oil_cap']],
            'symptom_knocking_sound': [symptoms['knocking']],
            'symptom_unstable_handling': [symptoms['unstable']],
            'symptom_windshieldspray_break': [symptoms['washer']],
            'battery_light_on': [current_battery_light]
        }

        df = pd.DataFrame(input_dict)

        return {
            "scheduler": model_scheduler.predict(df)[0].tolist(),
            "wear_tear": model_wear_tear.predict(df)[0].tolist(),
            "doctor":    model_doctor.predict(df)[0].tolist()
        }

    except Exception as e:
        print(f"Prediction Error: {str(e)}")
        raise HTTPException(status_code=500, detail=str(e))

if __name__ == "__main__":
    import uvicorn
    uvicorn.run(app, host="127.0.0.1", port=8001)