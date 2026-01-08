import os
import joblib
import pandas as pd
import numpy as np
from fastapi import FastAPI, HTTPException
from pydantic import BaseModel

app = FastAPI(title="AutoMate AI Vehicle Diagnostic Service")

# --- CONFIGURATION ---
# Path to your Jupyter notebooks folder containing the .pkl files
MODEL_DIR = r"C:\Users\hazee\Documents\Jupyter Projects\AutoMate_AI\notebooks"

# --- MODEL LOADING ---
try:
    # Match the exact filenames from your Jupyter directory
    model_scheduler = joblib.load(os.path.join(MODEL_DIR, 'Scheduler_Tree.pkl'))
    model_wear_tear = joblib.load(os.path.join(MODEL_DIR, 'WearTear_Tree.pkl'))
    model_doctor    = joblib.load(os.path.join(MODEL_DIR, 'Doctor_Tree.pkl'))
    print("✅ All Decision Tree models (13-feature versions) loaded successfully.")
except Exception as e:
    print(f"❌ CRITICAL ERROR LOADING MODELS: {str(e)}")

# --- DATA SCHEMA ---
class VehicleFeatures(BaseModel):
    # These must match the order and naming from your Phase 4 training
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

@app.post("/predict")
def predict_maintenance(data: VehicleFeatures):
    try:
        # 1. Map input to a dictionary with the EXACT column names from training
        input_dict = {
            'age': [data.age],
            'fuel_type': [data.fuel_type],
            'transmission_type': [data.transmission_type],
            'engine_size': [data.engine_size],
            'mileage': [data.mileage],
            'tyre_tread': [data.tyre_tread],
            'brake_effectiveness': [data.brake_effectiveness],
            'brand': [data.brand],
            'model': [data.model],
            'registered_year': [data.registered_year],
            'engine_noise': [data.engine_noise],
            'engine_light': [data.engine_light],
            'battery_light_on': [data.battery_light_on]
        }

        # 2. Convert to DataFrame to provide "Feature Names" and resolve UserWarnings
        df = pd.DataFrame(input_dict)

        # 3. Generate predictions (converting numpy arrays to standard Python lists)
        return {
            "scheduler": model_scheduler.predict(df)[0].tolist(),
            "wear_tear": model_wear_tear.predict(df)[0].tolist(),
            "doctor":    model_doctor.predict(df)[0].tolist()
        }

    except Exception as e:
        # Log error in terminal and return 500 to Laravel
        print(f"Prediction Error: {str(e)}")
        raise HTTPException(status_code=500, detail=str(e))

if __name__ == "__main__":
    import uvicorn
    # Use port 8001 to avoid conflict with Laravel's default 8000
    uvicorn.run(app, host="127.0.0.1", port=8001)