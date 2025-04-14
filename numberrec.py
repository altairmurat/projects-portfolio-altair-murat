import tensorflow as tf
import numpy as np
from PIL import Image

mnist = tf.keras.datasets.mnist
(x_train, y_train), (x_test, y_test) = mnist.load_data()

x_train, x_test = x_train / 255.0, x_test / 255.0

x_train = x_train.reshape(-1, 28 * 28)
x_test = x_test.reshape(-1, 28 * 28)

model = tf.keras.models.Sequential([tf.keras.layers.Input(shape=(28 * 28,)), tf.keras.layers.Dense(128, activation='relu'), tf.keras.layers.Dense(10, activation='softmax')])

model.compile(optimizer='adam', loss=tf.keras.losses.SparseCategoricalCrossentropy(), metrics=['accuracy'])

model.fit(x_train, y_train, epochs=10, validation_data=(x_test, y_test))

def recognize_digit(image_path):
    image = Image.open(image_path).convert('L').resize((28, 28))
    image_array = np.array(image)
    image_array = image_array / 255.0
    image_array = 1.0 - image_array
    image_vector = image_array.reshape(1, 28 * 28)
    prediction = model.predict(image_vector)
    predicted_label = np.argmax(prediction)
    return predicted_label

# Test the function
print(recognize_digit("sultann.jpg"))