import pygame
import sys
import random

pygame.init()
size = WIDTH, HEIGHT = (800,600)
screen = pygame.display.set_mode(size)
pygame.display.set_caption("Main menu")
clock = pygame.time.Clock()
fps = 60

TEXT_COLOR_MENU = (255,255,255)
TEXT_COLOR_GAME = (0,0,0)
HIGHLIGHT = (255,0,255)

font = pygame.font.SysFont("Times New Roman", size = 60, bold=True)
font_medium = pygame.font.SysFont("Times New Roman", size = 20)
font_smaller = pygame.font.SysFont("Times New Roman", size = 10, bold=True)

button_sound = pygame.mixer.Sound("Subway-Surfers-Theme-Sound-Effect.mp3")

selected_index = 0
buttons = ["Play", "Help", "Quit"]

#Draw buttons
def draw_buttons():
    for i, text in enumerate(buttons):
        if i == selected_index:
            label = font.render(text, True, HIGHLIGHT)
        else:
            label = font.render(text, True, TEXT_COLOR_MENU)
        x = WIDTH // 2 - label.get_width() // 2
        y = HEIGHT // 2 + i*80 - len(buttons) * 40
        screen.blit(label, (x,y))

#Menu (up,down,enter)
def keyboard_manage_menu(event):
    global selected_index
    if event.type == pygame.KEYDOWN:
        if event.key == pygame.K_UP:
            selected_index = (selected_index - 1) % len(buttons)
        elif event.key == pygame.K_DOWN:
            selected_index = (selected_index + 1) % len(buttons)
        elif event.key == pygame.K_RETURN: #enter button
            selection_in_menu()

def game_start():
    global running
    button_sound.play()
    #velocity of player
    player_velocity = 10
    #load of image
    player_image = pygame.image.load('police.jpg')
    player_image = pygame.transform.scale(player_image, (50, 50))
    #image into rect
    player_size = 50
    player = pygame.Rect(WIDTH//2, HEIGHT-100, player_size, player_size)

    #enemy velocity
    enemy_velocity = 7
    #image load
    enemy_image = pygame.image.load('bot.jpg')
    enemy_image = pygame.transform.scale(enemy_image, (60,60))
    #image into rect
    enemy_size = 60
    x_ran = random.randrange(enemy_size, WIDTH-enemy_size, 50)
    enemy = pygame.Rect(x_ran, 50, enemy_size, enemy_size)

    score = 0

    while running:
        pygame.time.delay(30)
        screen.fill((255,255,255))
        for event in pygame.event.get():
            if event.type == pygame.QUIT:
                pygame.quit()
                sys.exit()
            elif event.type == pygame.KEYDOWN and event.key == pygame.K_ESCAPE:
                menu()
                pygame.quit()
            elif score == 5:
                game_level2()
                pygame.quit()

        help_text = font_smaller.render("ESC for menu opening", True, TEXT_COLOR_GAME)
        score_text = font_smaller.render(f"Caught number of boys: {int(score)}", True, TEXT_COLOR_GAME)

        keys = pygame.key.get_pressed()
        if keys[pygame.K_w] and player.y > 0:
            player.y -= player_velocity
        if keys[pygame.K_s] and player.y < HEIGHT-player_size:
            player.y += player_velocity
        if keys[pygame.K_a] and player.x > 0:
            player.x -= player_velocity
        if keys[pygame.K_d] and player.x < WIDTH-player_size:
            player.x += player_velocity

        #enemy movement
        enemy.y += enemy_velocity
        if enemy.y > HEIGHT:
            enemy.x = random.randrange(enemy_size, WIDTH-enemy_size, 50)
            enemy.y = 50

        if player.colliderect(enemy):
            enemy.x = random.randrange(enemy_size, WIDTH-enemy_size, 50)
            enemy.y = 50
            score += 1

        screen.blit(help_text, (10,10))
        screen.blit(score_text, (10,20))
        screen.blit(enemy_image, (enemy.x, enemy.y))
        screen.blit(player_image, (player.x, player.y))
        pygame.display.flip()
        
def game_level2():
    global running

    score2 = 5
    
    #velocity of player
    player_velocity = 10
    #load of image
    player_image = pygame.image.load('police.jpg')
    player_image = pygame.transform.scale(player_image, (50, 50))
    #image into rect
    player_size = 50
    player = pygame.Rect(WIDTH//2, HEIGHT-100, player_size, player_size)

    #enemy velocity
    enemy_velocity = 7
    #image load
    enemy_image = pygame.image.load('bot.jpg')
    enemy_image = pygame.transform.scale(enemy_image, (60,60))
    #image into rect
    enemy_size = 60
    x_ran = random.randrange(enemy_size, WIDTH-enemy_size, 50)
    enemy = pygame.Rect(x_ran, 50, enemy_size, enemy_size)
    
    #second enemy
    enemy_image2 = pygame.image.load('train.png')
    enemy_image2 = pygame.transform.scale(enemy_image2, (60,60))
    enemy_size2 = 60
    x_ran2 = random.randrange(enemy_size2, WIDTH-enemy_size2, 50)
    if x_ran == x_ran2:
        x_ran3 = random.randrange(enemy_size2, WIDTH-enemy_size2, 50)
        x_ran2 = x_ran3
    enemy2 = pygame.Rect(x_ran2, 50, enemy_size, enemy_size)

    health = 100

    while running:
        pygame.time.delay(30)
        screen.fill((200,200,200))
        for event in pygame.event.get():
            if event.type == pygame.QUIT:
                pygame.quit()
                sys.exit()
            elif event.type == pygame.KEYDOWN and event.key == pygame.K_ESCAPE:
                menu()
                pygame.quit()
            elif score2 == 25:
                pygame.quit()
            elif health == 0:
                screen.blit(font.render(f"You have lost: {int(score2)}", True, TEXT_COLOR_GAME), (390, 400))
                pygame.time.delay(3000)
                pygame.quit()

        help_text = font_smaller.render("ESC for menu opening", True, TEXT_COLOR_GAME)
        score_text = font_smaller.render(f"Caught number of boys: {int(score2)}", True, TEXT_COLOR_GAME)
        health_text = font_smaller.render(f"Health: {int(health)}", True, TEXT_COLOR_GAME)

        keys = pygame.key.get_pressed()
        if keys[pygame.K_w] and player.y > 0:
            player.y -= player_velocity
        if keys[pygame.K_s] and player.y < HEIGHT-player_size:
            player.y += player_velocity
        if keys[pygame.K_a] and player.x > 0:
            player.x -= player_velocity
        if keys[pygame.K_d] and player.x < WIDTH-player_size:
            player.x += player_velocity

        #enemy movement
        enemy.y += enemy_velocity
        if enemy.y > HEIGHT:
            enemy.x = random.randrange(enemy_size, WIDTH-enemy_size, 50)
            enemy.y = 50
            
        enemy2.y += enemy_velocity
        if enemy2.y > HEIGHT:
            enemy2.x = random.randrange(enemy_size2, WIDTH-enemy_size2, 50)
            enemy2.y = 50

        if player.colliderect(enemy):
            enemy.x = random.randrange(enemy_size, WIDTH-enemy_size, 50)
            enemy.y = 50
            score2 += 1
            
        if player.colliderect(enemy2):
            enemy2.x = random.randrange(enemy_size2, WIDTH-enemy_size2, 50)
            enemy2.y = 50
            health -= 10

        screen.blit(help_text, (10,10))
        screen.blit(score_text, (10,20))
        screen.blit(health_text, (10,30))
        screen.blit(enemy_image2, (enemy2.x, enemy2.y))
        screen.blit(enemy_image, (enemy.x, enemy.y))
        screen.blit(player_image, (player.x, player.y))
        pygame.display.flip()
        

def selection_in_menu():
    global running
    if buttons[selected_index] == "Play":
        game_start()
    if buttons[selected_index] == "Help":
        instruction_start()
    if buttons[selected_index] == "Quit":
        pygame.quit()

def instruction_start():
    global running
    screen.fill((0,0,0))
    while running:
        for event in pygame.event.get():
            if event.type == pygame.QUIT:
                pygame.quit()
            elif event.type == pygame.KEYDOWN and event.key == pygame.K_ESCAPE:
                menu()
        helptext = font_medium.render("You are policeman, and you should catch little boys who interrupts you.", True, TEXT_COLOR_MENU)
        helptext2 = font_medium.render("However, be afraid of 8 number since it can decrease your health. This game has 2 levels.", True, TEXT_COLOR_MENU)
        screen.blit(helptext2, (10,320))
        screen.blit(helptext, (10,300))
        pygame.display.update()
        
            

def menu():
    running = True
    while running:
        screen.fill((0,0,0))
        for event in pygame.event.get():
            if event.type == pygame.QUIT:
                running = False
            keyboard_manage_menu(event)
        
        draw_buttons()
        pygame.display.flip()

running = True
while running:
    for event in pygame.event.get():
        if event.type == pygame.QUIT:
            running = False
        menu()
        
    draw_buttons()
    pygame.display.flip()

pygame.quit()
sys.exit